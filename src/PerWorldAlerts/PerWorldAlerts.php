<?php

/*
 * PerWorldAlerts (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.it
 * Date: 27/04/2018 02:01 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PerWorldAlerts/blob/master/LICENSE)
 */

namespace PerWorldAlerts;

use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class PerWorldAlerts extends PluginBase {
    
    /** @var string */
	const PREFIX = "&a[&bPer&cWorld&eAlerts&a] ";
	
    /**
	 * Translate Minecraft colors
	 * @param string $symbol
	 * @param string $message
	 * @return string
	 */
	public function translateColors($symbol, $message){
	    
	    $message = str_replace($symbol . "0", TextFormat::BLACK, $message);
	    $message = str_replace($symbol . "1", TextFormat::DARK_BLUE, $message);
	    $message = str_replace($symbol . "2", TextFormat::DARK_GREEN, $message);
	    $message = str_replace($symbol . "3", TextFormat::DARK_AQUA, $message);
	    $message = str_replace($symbol . "4", TextFormat::DARK_RED, $message);
	    $message = str_replace($symbol . "5", TextFormat::DARK_PURPLE, $message);
	    $message = str_replace($symbol . "6", TextFormat::GOLD, $message);
	    $message = str_replace($symbol . "7", TextFormat::GRAY, $message);
	    $message = str_replace($symbol . "8", TextFormat::DARK_GRAY, $message);
	    $message = str_replace($symbol . "9", TextFormat::BLUE, $message);
	    $message = str_replace($symbol . "a", TextFormat::GREEN, $message);
	    $message = str_replace($symbol . "b", TextFormat::AQUA, $message);
	    $message = str_replace($symbol . "c", TextFormat::RED, $message);
	    $message = str_replace($symbol . "d", TextFormat::LIGHT_PURPLE, $message);
	    $message = str_replace($symbol . "e", TextFormat::YELLOW, $message);
	    $message = str_replace($symbol . "f", TextFormat::WHITE, $message);
	    
	    $message = str_replace($symbol . "k", TextFormat::OBFUSCATED, $message);
	    $message = str_replace($symbol . "l", TextFormat::BOLD, $message);
	    $message = str_replace($symbol . "m", TextFormat::STRIKETHROUGH, $message);
	    $message = str_replace($symbol . "n", TextFormat::UNDERLINE, $message);
	    $message = str_replace($symbol . "o", TextFormat::ITALIC, $message);
	    $message = str_replace($symbol . "r", TextFormat::RESET, $message);
	    
	    return $message;
	}
	
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    
    /**
     * Send alerts on the specified world
     * @param Level $level
     * @param string $message
     */
    public function sendLevelAlert(Level $level, $message){
    	$cfg = $this->getConfig()->getAll();
		foreach($level->getPlayers() as $player){
			$player->sendMessage($this->translateColors("&", $message));
		}
		//Check log-on-console
		if($cfg["log-on-console"] == true){
			Server::getInstance()->getLogger()->info($this->translateColors("&", $message));
		}
    }
    
    /**
     * Check if alerts are disabled on the specified world
     * @param string
     * @return bool
     */
    public function isAlertDisabled($level) : bool {
        $cfg = $this->getConfig()->getAll();
        foreach($cfg["disabled-in-worlds"] as $item){
            if(strcasecmp($item, $level) == 0){
                return true;
            }
        }
        return false;
    }
}