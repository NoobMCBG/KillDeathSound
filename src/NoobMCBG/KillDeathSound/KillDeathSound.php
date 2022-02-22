<?php

declare(strict_types=1);

namespace NoobMCBG\KillDeathSound;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\world\particle\HeartParticle; 
use pocketmine\world\particle\InkParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\AngryVillagerParticle;
use pocketmine\world\particle\EndermanTeleportParticle;
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SnowballPoofParticle;
use pocketmine\world\particle\SmokeParticle;
use pocketmine\world\particle\WaterDripParticle;

class KillDeathSound extends PluginBase implements Listener {
    
        /** @var KillDeathSound */
	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}
        
	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->checkUpdate();
		self::$instance = $this;
	}
	
	/** 
        * @param bool $isRetry = false
	*/
	public function checkUpdate(bool $isRetry = false): void {
            $this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
        }
    
        /**
        * @param PlayerDeathEvent $event
        */
	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getPlayer();
		if($player instanceof Player){
			if($this->getConfig()->getAll()["death"]["addsound"] == true){
			    $soundName = $this->getConfig()->getAll()["death"]["sound"];
			    $volume = $this->getConfig()->getAll()["death"]["volume"];
			    $pitch = $this->getConfig()->getAll()["death"]["pitch"];
			    $this->playSound($player, $soundName, $volume, $pitch);
			}
			if($this->getConfig()->getAll()["death"]["particle"] == true){
				if($this->getConfig()->getAll()["death"]["particle"]["addparticle"] == true){
					if($this->getConfig()->getAll()["death"]["particle"]["heart"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new HeartParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["ink"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new InkParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["lava"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new LavaParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["angryvillager"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new AngryVillagerParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["endermanteleport"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new EndermanTeleportParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["critical"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new CriticalParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["explode"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new ExplodeParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["happyvillager"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new HappyVillagerParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["portal"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new PortalParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["redstone"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new RedstoneParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["snowballpoof"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new SnowballPoofParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["smoke"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new SmokeParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
					if($this->getConfig()->getAll()["death"]["particle"]["waterdrip"] == true){
					        $pos = $player->getPosition()->add($this->getConfig()->getAll()["death"]["particle"]["width"], $this->getConfig()->getAll()["death"]["particle"]["high"], $this->getConfig()->getAll()["death"]["particle"]["width"]);;
		    			        $particle = new WaterDripParticle($pos);
		    			        $player->getPosition()->getWorld()->addParticle($pos, $particle);
					}
				}
			}
		}
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				if($this->getConfig()->getAll()["kill"]["addsound"] == true){
				    $soundName = $this->getConfig()->getAll()["kill"]["sound"];
			            $volume = $this->getConfig()->getAll()["kill"]["volume"];
			            $pitch = $this->getConfig()->getAll()["kill"]["pitch"];
				    $this->playSound($player, $soundName, $volume, $pitch);
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
		            $soundName = $this->getConfig()->getAll()["hit"]["sound"];
			    $volume = $this->getConfig()->getAll()["hit"]["volume"];
			    $pitch = $this->getConfig()->getAll()["hit"]["pitch"];
                            $this->playSound($attacker, $soundName, $volume, $pitch);
                        }
		}
		if($entity instanceof Player){
			if($this->getConfig()->getAll()["hit"]["addsound"] == true){
			    $soundName = $this->getConfig()->getAll()["hit"]["sound"];
			    $volume = $this->getConfig()->getAll()["hit"]["volume"];
			    $pitch = $this->getConfig()->getAll()["hit"]["pitch"];
                            $this->playSound($entity, $soundName, $volume, $pitch);
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
}
