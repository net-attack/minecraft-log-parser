# minecraft-log-parser
Small Php example with Mahatma Gantti
## Dependencies
* sudo apt install php


## Install

Edit the index.php and change folder of
```
$minecraftParser = new MinecraftParser("logs/"); //Change to your server log folder containing *.log
$data = $minecraftParser->printInfo();
```

## Run

```
git clone https://github.com/net-attack/minecraft-log-parser.git
cd src 
php -S localhost:8000
```
