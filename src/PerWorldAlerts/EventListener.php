<?php

/*
 * PerWorldAlerts (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 28/12/2014 12:52 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldAlerts/blob/master/LICENSE)
 */

namespace PerWorldAlerts;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class EventListener extends PluginBase implements Listener{
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onPlayerJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$message = $event->getJoinMessage();
		$event->setJoinMessage("");
		if($message != "" || $message != " "){
			if($this->plugin->isAlertDisabled($player->getLevel()->getName()) == false){
				$this->plugin->SendLevelAlert($player->getLevel()->getName(), $message);
			}
		}
	}
	
	public function onPlayerQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		$message = $event->getQuitMessage();
		$event->setQuitMessage("");
		if($message != "" || $message != " "){
			if($this->plugin->isAlertDisabled($player->getLevel()->getName()) == false){
				$this->plugin->SendLevelAlert($player->getLevel()->getName(), $message);
			}
		}
	}
	
	public function onPlayerDeath(PlayerDeathEvent $event){
		$player = $event->getEntity();
		if($player instanceof Player){
			$message = $event->getDeathMessage();
			$event->setDeathMessage("");
			if($message != "" || $message != " "){
				if($this->plugin->isAlertDisabled($player->getLevel()->getName()) == false){
					$this->plugin->SendLevelAlert($player->getLevel()->getName(), $message);
				}
			}
		}
	}
	
}
?>
