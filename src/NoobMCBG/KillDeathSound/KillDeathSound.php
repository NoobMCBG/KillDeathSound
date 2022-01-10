<?php

declare(strict_types=1);

namespace NoobMCBG\KillDeathSound;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KillDeathSound extends PluginBase implements Listener {
        
	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->config = $this->getConfig()->getAll();
	}

	public function onDeath(PlayerDeathEvent $ev){
		$player = $ev->getPlayer();
		if($player instanceof Player){
			$this->PlaySound($player, $this->getConfig()->getAll()["death"]["sound"], $this->getConfig()->getAll()["death"]["volume"], $this->getConfig()->getAll()["death"]["pitch"]);
		}
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				$this->PlaySound($player, $this->getConfig()->getAll()["kill"]["sound"], $this->getConfig()->getAll()["kill"]["volume"], $this->getConfig()->getAll()["kill"]["pitch"]);
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
