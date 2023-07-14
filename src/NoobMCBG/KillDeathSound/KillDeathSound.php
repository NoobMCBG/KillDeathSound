<?php

declare(strict_types=1);

namespace NoobMCBG\KillDeathSound;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\block\VanillaBlocks;
use pocketmine\world\Position;
use pocketmine\world\World;
use pocketmine\world\particle\BlockBreakParticle;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class KillDeathSound extends PluginBase implements Listener {
	
	protected $configversion = "3.0.3";
    
        /** @var KillDeathSound */
	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}
        
	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->checkUpdate();
		$this->checkConfigUpdate();
		self::$instance = $this;
	}
	
	/** 
        * @param bool $isRetry = false
	*/
	public function checkUpdate(bool $isRetry = false): void {
            	$this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
        }
	/** 
        * @return void
	*/
	protected function checkConfigUpdate(): void{
        	$updateconfig = false;

        	if(!$this->getConfig()->exists("config-version")){
            		$updateconfig = true;
        	}

        	if($this->getConfig()->get("config-version") !== $this->configversion){
            		$updateconfig = true;
        	}

       		if($updateconfig){
            		@unlink($this->getDataFolder()."config.yml");
            		$this->saveDefaultConfig();
        	}
    	}
    
        /**
        * @param PlayerDeathEvent $event
        */
	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getPlayer();
		if($player instanceof Player){
			if($this->getConfig()->getAll()["death"]["addsound"] == true){
			    	$volume = $this->getConfig()->getAll()["death"]["volume"];
			    	$pitch = $this->getConfig()->getAll()["death"]["pitch"];
				foreach($this->getConfig()->getAll()["death"]["sound"] as $soundName){
			    		$this->playSound($player, $soundName, $volume, $pitch);
				}
			        if($this->getConfig()->getAll()["death"]["blood"] == true){
					$this->addBlood($player->getPosition());
				}
			}
		}
		if($this->getConfig()->getAll()["death"]["blood"] == true){
			if($this->getConfig()->getAll()["death"]["blood-all-entity"] == true){
				$this->addBlood($player->getPosition());
			}else{
				if($player instanceof Player){
					$this->addBlood($player->getPosition());
				}
			}
		}
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				if($this->getConfig()->getAll()["kill"]["addsound"] == true){
			            	$volume = $this->getConfig()->getAll()["kill"]["volume"];
			            	$pitch = $this->getConfig()->getAll()["kill"]["pitch"];
				   	foreach($this->getConfig()->getAll()["kill"]["sound"] as $soundName){
			    			$this->playSound($damager, $soundName, $volume, $pitch);
					}
				}
			}
			if($this->getConfig()->getAll()["kill"]["blood"] == true){
				if($this->getConfig()->getAll()["kill"]["blood-all-entity"] == true){
					$this->addBlood($damager->getPosition());
				}else{
					if($damager instanceof Player){
						$this->addBlood($damager->getPosition());
					}
				}
			}
		}
	}
    
        /**
        * @param EntityDamageByEntityEvent $event
        */
	public function onHit(EntityDamageByEntityEvent $event){
		$attacker = $event->getDamager();
		$entity = $event->getEntity();
		if($attacker instanceof Player){
			if($this->getConfig()->getAll()["hit"]["addsound"] == true){
			    	$volume = $this->getConfig()->getAll()["hit"]["volume"];
			    	$pitch = $this->getConfig()->getAll()["hit"]["pitch"];
                            	foreach($this->getConfig()->getAll()["hit"]["sound"] as $soundName){
			    		$this->playSound($attacker, $soundName, $volume, $pitch);
				}
                        }
		}
		if($this->getConfig()->getAll()["hit"]["blood"] == true){
			if($this->getConfig()->getAll()["hit"]["blood-all-entity"] == true){
				if($this->getConfig()->getAll()["hit"]["blood-to-attacker"] !== true){
					$this->addBlood($attacker->getPosition());
				}
			}else{
				if($this->getConfig()->getAll()["hit"]["blood-to-attacker"] == true){
					if($attacker instanceof Player){
						$this->addBlood($attacker->getPosition());
					}
				}
			}
		}
		if($entity instanceof Player){
			if($this->getConfig()->getAll()["hit"]["addsound"] == true){
			    	$volume = $this->getConfig()->getAll()["hit"]["volume"];
			    	$pitch = $this->getConfig()->getAll()["hit"]["pitch"];
                            	foreach($this->getConfig()->getAll()["hit"]["sound"] as $soundName){
			    		$this->playSound($entity, $soundName, $volume, $pitch);
				}
                        }
		}
		if($this->getConfig()->getAll()["hit"]["blood"] == true){
			if($this->getConfig()->getAll()["hit"]["blood-all-entity"] == true){
				$this->addBlood($entity->getPosition());
			}else{
				if($entity instanceof Player){
					$this->addBlood($entity->getPosition());
				}
			}
		}
	}
    
        /**
        * @param Player $player
        * @param string $soundName
        * @param float $volume = 0
        * @param float $pitch = 0
        */
	public function playSound(Player $player, string $soundName, float $volume = 0, float $pitch = 0) : void {
		$packet = new PlaySoundPacket();
		$packet->soundName = $soundName;
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->volume = $volume;
		$packet->pitch = $pitch;
		$player->getNetworkSession()->sendDataPacket($packet);
	}
	
	public function addBlood(Position $pos) : void {
		$pos->getWorld()->addParticle($pos->asVector3(), new BlockBreakParticle(VanillaBlocks::REDSTONE()));
	}
	
	public function addBloodAt(float|int $x, float|int $y, float|int $z, World $world) : void {
		$world->addParticle(new Vector3($x, $y, $z), new BlockBreakParticle(VanillaBlocks::REDSTONE()));
	}
}
