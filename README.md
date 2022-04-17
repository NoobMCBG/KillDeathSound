<div align="center">
<h1>KillDeathSound | v3.0.2<h1>
</div>
<p align="center">
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.state/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.api/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.dl.total/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.dl/KillDeathSound"></a>
<br>
✔️ When the player is killed and dies, the sound will work ✔️
<br>
<img src="https://github.com/NoobMCBG/KillDeathSound/blob/main/icon.png"/>
<br>
✔️ Can be set to work or not ✔️
<br>
✔️ added sound when hitting or archery hits the enemy ✔️
<br>
✔️ Can access to KillDeathSound ✔️
<br>
✔️ Generates blood particles when killed, killed, punched, and hit by archery ✔️
<br>
✔️ It is possible for all entities to bleed when punching, arching, killing, dying ✔️
<br>
✔️ Customizable Add Blood Particle to attacker ✔️
</p>

## Update
| **Update** | **State**|
| --- | --- |
| **Can be set to work or not** | **✔️**|
| **added sound when hitting or archery hits the enemy** | **✔️**|
| **Can access to KillDeathSound** | **✔️**|
| **Generates blood particles when killed, killed, punched, and hit by archery** | **✔️**|
| **It is possible for all entities to bleed when punching, arching, killing, dying** | **✔️**|
| **`Customizable Add Blood Particle to attacker`** | **✔️**|
| **add `addBlood()` and `addBloodAt()` for Developer** | **✔️**|


<br>

## Features
>- When the player is killed and dies, the sound will work
>- Generates blood particles when killed, killed, punched, and hit by archery
>- added sound when hitting or archery hits the enemy
  
<br>

## Config
```yaml
---
# config.yml
#    
#    ██╗░░██╗██╗██╗░░░░░██╗░░░░░██████╗░███████╗░█████╗░████████╗██╗░░██╗░██████╗░█████╗░██╗░░░██╗███╗░░██╗██████╗░
#    ██║░██╔╝██║██║░░░░░██║░░░░░██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██║░░██║██╔════╝██╔══██╗██║░░░██║████╗░██║██╔══██╗
#    █████═╝░██║██║░░░░░██║░░░░░██║░░██║█████╗░░███████║░░░██║░░░███████║╚█████╗░██║░░██║██║░░░██║██╔██╗██║██║░░██║
#    ██╔═██╗░██║██║░░░░░██║░░░░░██║░░██║██╔══╝░░██╔══██║░░░██║░░░██╔══██║░╚═══██╗██║░░██║██║░░░██║██║╚████║██║░░██║
#    ██║░╚██╗██║███████╗███████╗██████╔╝███████╗██║░░██║░░░██║░░░██║░░██║██████╔╝╚█████╔╝╚██████╔╝██║░╚███║██████╔╝
#    ╚═╝░░╚═╝╚═╝╚══════╝╚══════╝╚═════╝░╚══════╝╚═╝░░╚═╝░░░╚═╝░░░╚═╝░░╚═╝╚═════╝░░╚════╝░░╚═════╝░╚═╝░░╚══╝╚═════╝░
#
# You can see the list of sound effects at this link: "https://www.digminecraft.com/lists/sound_list_pe.php"

# Player Death
death:
  addsound: true
  blood: true
  blood-all-entity: true # Add Blood Particle to all entity hit, arching
  sound: # Sound name
  - "random.explode"
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds

# Player Kills
kill:
  addsound: true
  blood: true
  blood-all-entity: true # Add Blood Particle to all entity hit, arching
  sound: # Sound name
  - "random.levelup"
  - "random.totem"
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds
  particle: # Particle death
  
# Player Hit & Archery
hit:
  addsound: true
  blood: true
  blood-all-entity: true # Add Blood Particle to all entity hit, arching
  blood-to-attacker: false # Add Blood Particle to attacker
  sound: # Sound name
  - "random.orb"
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds
...
```

<br>

## For Developer
>- You can access to KillDeathSound by using ```KillDeathSound::getInstance()```
>- Add sound usage:
```php
$player = $event->getPlayer();
$soundName = "random.explode";
$volume = 1;
$pitch = 1;
KillDeathSound::getInstance()->playSound($player, $soundName, $volume, $pitch);
```

>- Add Blood Particle usage:
```php
$position = $event->getPlayer()->getPosition();
KillDeathSound::getInstance()->addBlood($position);

// or

$x = $event->getPlayer()->getPosition()->getX();
$y = $event->getPlayer()->getPosition()->getY();
$z = $event->getPlayer()->getPosition()->getZ();
$world = $event->getPlayer()->getPosition()->getWOrld();
KillDeathSound::getInstance()->addBloodAt($x, $y, $z, $world);
```

<br>

## Install
>- Step 1: Click the `Direct Download` button to download the plugin
>- Step 2: move the file `KillDeathSound.phar` into the file `plugins`
>- Step 3: Restart server for plugins to work
