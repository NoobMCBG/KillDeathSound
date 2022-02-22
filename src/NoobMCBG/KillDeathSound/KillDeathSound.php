<?php

declare(strict_types=1);

namespace NoobMCBG\KillDeathSound;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

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
