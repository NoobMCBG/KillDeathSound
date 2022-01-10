<?php

declare(strict_types=1);

namespace NoobMCBG\KillDeathSound;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class KillDeathSound extends PluginBase implements Listener {
        
	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}

	public function onDeath(PlayerDeathEvent $ev){
		$player = $ev->getPlayer();
		if($player instanceof Player){
			$soundName = $this->getConfig()->getAll()["death"]["sound"];
			$volume = $this->getConfig()->getAll()["death"]["volume"];
			$pitch = $this->getConfig()->getAll()["death"]["pitch"];
			$this->PlaySound($player, $soundName, $volume, $pitch);
		}
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				$soundName = $this->getConfig()->getAll()["kill"]["sound"];
			        $volume = $this->getConfig()->getAll()["kill"]["volume"];
			        $pitch = $this->getConfig()->getAll()["kill"]["pitch"];
				$this->PlaySound($player, $soundName, $volume, $pitch);
			}
		}
	}

	public function PlaySound(Player $player, string $soundName, float $volume = 0, float $pitch = 0) : void {
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
