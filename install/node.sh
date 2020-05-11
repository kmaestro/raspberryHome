#!/usr/bin/env zsh
sudo apt update -y && sudo apt upgrade -y
git clone https://github.com/creationix/nvm.git ~/.nvm
sudo echo "source ~/.nvm/nvm.sh" >> ~/.zshrc && sudo echo "source ~/.nvm/nvm.sh" >> ~/.profile
source ~/.zshrc

nvm install node