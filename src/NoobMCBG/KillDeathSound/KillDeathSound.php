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
			self::PlaySound($player, $this->config["death"]["sound"], $this->config["death"]["volume"], $this->config["death"]["pitch"]);
		}
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				self::PlaySound($player, $this->config["kill"]["sound"], $this->config["kill"]["volume"], $this->config["kill"]["pitch"]);
			}
		}
	}

	public static function PlaySound(Player $player, string $soundName, float $volume = 1, float $pitch = 1) : void {
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