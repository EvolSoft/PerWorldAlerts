<?php

/*
 * PerWorldAlerts (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 04/01/2018 04:38 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldAlerts/blob/master/LICENSE)
 */

namespace PerWorldAlerts;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class EventListener extends PluginBase implements Listener {
	
	public function __construct(PerWorldAlerts $plugin){
		$this->plugin = $plugin;
	}
	
	/**
	 * @param PlayerJoinEvent $event
	 */
	public function onPlayerJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$message = $event->getJoinMessage();
		$event->setJoinMessage("");
		if($message != null && !ctype_space($message)){
			if(!$this->plugin->isAlertDisabled($player->getLevel()->getName())){
				$this->plugin->sendLevelAlert($player->getLevel(), $message);
			}
		}
	}
	
	/**
	 * @param PlayerQuitEvent $event
	 */
	public function onPlayerQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		$message = $event->getQuitMessage();
		$event->setQuitMessage("");
		if($message != null && !ctype_space($message)){
			if(!$this->plugin->isAlertDisabled($player->getLevel()->getName())){
				$this->plugin->sendLevelAlert($player->getLevel(), $message);
			}
		}
	}
	
	/**
	 * @param PlayerDeathEvent $event
	 */
	public function onPlayerDeath(PlayerDeathEvent $event){
		$player = $event->getEntity();
		if($player instanceof Player){
			$message = $event->getDeathMessage();
			$event->setDeathMessage("");
			if($message != null && !ctype_space($message)){
				if(!$this->plugin->isAlertDisabled($player->getLevel()->getName())){
					$this->plugin->sendLevelAlert($player->getLevel(), $message);
				}
			}
		}
	}
}