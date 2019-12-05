<?php

namespace PlayerDaten;

use pocketmine\{
    Server,
    Player
};
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\{
    Config
};
use pocketmine\event\player\{
    PlayerJoinEvent
};

class pd extends PluginBase implements Listener{
    
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onJoin(PlayerJoinEvent $event){
        if(!file_exists($this->getDataFolder() . $event->getPlayer()->getName() . ".yml")){
            $today = new \DateTime("now");
            $config = new Config($this->getDataFolder() . $event->getPlayer()->getName() . ".yml", Config::YAML);
            $config->set("Name", $event->getPlayer()->getName());
            $config->set("IP-Adresse", $event->getPlayer()->getAddress());
            $config->set("Erster-Join", $today->format("d.m.Y H:i"));
            $config->save();
        }
    }
}
