<?php

namespace auto;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\Listener;

use pocketmine\level\Level;
use pocketmine\level\Position;

use auto\ResetTask;

class Main extends PluginBase implements Listener {
  
  public function onEnable(){
    $this->getLogger()->info("Plugin Enable");
    $this->task1 = new ResetTask($this);
    $this->getScheduler()->scheduleRepeatingTask($this->task1, 6000);
  }
  
  public function onDisable(){
    $this->getLogger()->info("Plugin Disable");
  }
  
  public function resetmine() : void{
    $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "mine reset-all");
    $this->getServer()->broadcastMessage("§l§a»» Tất cả các khu Mine đã được reset !!!");
    $level = $this->getServer()->getLevelByName("hub");
    foreach($this->getServer()->getOnlinePlayers() as $p){
      $p->teleport(new Position(0, 0, 0, $level));
    }
  }
}
