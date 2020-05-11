#!/usr/bin/env sh
sudo apt update -y && sudo apt upgrade -y
sudo apt-get install zsh
curl -L http://install.ohmyz.sh | sh
chsh -s /bin/zsh
sudo shutdown -r 0