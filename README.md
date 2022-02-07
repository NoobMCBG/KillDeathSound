<div align="center">
<h1>KillDeathSound | v2.0.0<h1>
</div>
<p align="center">
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.state/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.api/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.dl.total/KillDeathSound"></a>
<a href="https://poggit.pmmp.io/p/KillDeathSound"><img src="https://poggit.pmmp.io/shield.dl/KillDeathSound"></a>
<br>
✔️ When the player is killed and dies, the sound will work ✔️
<br>
<img src="https://github.com/NoobMCBG/KillDeathSound/blob/main/icon.png" />
<br>
✔️ Can be set to work or not ✔️
<br>
✔️ added sound when hitting or archery hits the enemy ✔️
<br>
✔️ Can access to KillDeathSound ✔️
<br>
❌ Effect on killing or dying ❌
</p>

## Update
| **Update** | **State**|
| --- | --- |
| **Can be set to work or not** | **✔️**|
| **added sound when hitting or archery hits the enemy** | **✔️**|
| **Can access to KillDeathSound** | **✔️**|
| **Effect on killing or dying** | **❌**|

<br>

## Features
- When the player is killed and dies, the sound will work

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
  sound: "random.explode" # Sound name
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds

# Player Kills
kill:
  addsound: true
  sound: "random.levelup" # Sound name
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds
# Player Hit & Archery
hit:
  addsound: true
  sound: "random.orb" # Sound name
  volume: 1 # Volume sounds
  pitch: 1 # Pitch sounds
...
```

<br>

## For Developer
- You can access to KillDeathSound by using ```KillDeathSound::getInstance()```
- Add sound usage:
```php
$player = $event->getPlayer();
$soundName = "random.explode";
$volume = 1;
$pitch = 1;
KillDeathSound::getInstance()->PlaySound($player, $soundName, $volume, $pitch);
```
  
<br>

## Install
- Step 1: Click the "Direct Download" button to download the plugin
- Step 2: move the file "KillDeathSound.phar" into the file "plugins"
- Step 3: Restart server for plugins to work
