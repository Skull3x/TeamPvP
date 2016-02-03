<?php 
 namespace src\Tasks; 
  
  
 use pocketmine\scheduler\PluginTask; 
 use pocketmine\level\Level; 
 use pocketmine\Player; 
 use pocketmine\Server; 
 use pocketmine\tile\Sign; 
 use pocketmine\scheduler\Task; 
 use pocketmine\scheduler\ServerScheduler; 
 use pocketmine\level\Position; 
 use pocketmine\math\Vector3; 
  
 class SignUpdaterTask extends PluginTask 
 { 
  
     public $f = 0; 
     public function __construct(\MCrafters\TeamPvP\TeamPvP $plugin) 
     { 
         parent::__construct($plugin); 
         $this->plugin = $plugin; 
     } 
  
     public function onRun($tick) 
     { 
         $this->f++; 
         if($this->f > 15){ 
             $a = new \MCrafters\TeamPvP\TeamPvP(); 
             $t = Server::getInstance()->getLevelByName($this->plugin->yml["sign_world"])->getTile(new Vector3($this->plugin->yml["sign_join_x"], $this->plugin->yml["sign_join_y"], $this->plugin->yml["sign_join_z"])); 
  
             if ($t instanceof Sign) { 
                 if ($this->plugin->gameStarted == true) { 
                     $t->setText( 
                         "§l§6Team§cPvP", 
                         "§l§cRed Team : " . count($this->plugin->reds), 
                         "§l§bBlue Team : " . count($this->plugin->blues), 
                         "§aStarted" 
                     ); 
                 } elseif ($this->plugin->gameStarted == false && count($this->plugin->reds) == 5 && count($this->plugin->blues) == 5) { 
                     $t->setText( 
                         "§l§6Team§cPvP", 
                         "§l§cRed Team : " . count($this->plugin->reds), 
                         "§l§bBlue Team : " . count($this->plugin->blues), 
                         "§aFull" 
                     ); 
                 } elseif ($this->plugin->gameStarted == false && !count($this->plugin->reds) < 5 && !count($this->plugin->blues) < 5) { 
                 $t->setText( 
                         "§l§6Team§cPvP", 
                         "§l§cRed Team : " . count($this->plugin->reds), 
                         "§l§bBlue Team : " . count($this->plugin->blues), 
                         "§aTap To Join!" 
                     ); 
                 } 
             } 
         } 
     } 
 }//Class 
