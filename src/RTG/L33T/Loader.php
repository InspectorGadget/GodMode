<?php

/*
 * All rights reserved RTGNetworkkk & L33T.cc
*/
 
namespace RTG\L33T;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;

class Loader extends PluginBase {
	
	public function onEnable() {
		$this->enabled = array();
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $param) {
		switch($cmd->getName()) {
			
			case "god":
				if($sender->hasPermission("godmode.toggle")) {
					if(isset($this->enabled[strtolower($sender->getName())])) {
						unset($this->enabled[strtolower($sender->getName())]);
						$sender->sendMessage("[God] You have left God Mode!");
					}
					else {
						$this->enabled[strtolower($sender->getName())] = strtolower($sender->getName());
						$sender->sendMessage("[God] You are now in God Mode!");
					}
				}
				else {
					$sender->sendMessage(TF::RED . "You have no permission to use this command!");
				}
				return true;
			break;
		
		}
	}
			
	public function onDeath(PlayerDeathEvent $e) {
		$p = $e->getPlayer();
		$n = $->getName();
			
			if(isset($this->enabled[strtolower($p->getName())])) {
				$e->setCancelled();
			}
	}
		
	public function onJoin(PlayerJoinEvent $e) {
		$p = $e->getPlayer();
		$n = $p->getName();
		
			if(isset($this->enabled[strtolower($p->getName())])) {
				unset($this->enabled[strtolower($p->getName())]);
				$sender->sendMessage("[God] You have been kicked from God Mode!");
				$this->getServer()->broadcastMessage("[God] $n has left God Mode!");
			}
	
	}
	
}	