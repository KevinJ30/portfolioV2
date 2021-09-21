@echo off

echo 'Synchronisation des données avec le serveur'

rsync -av --exclude=/.git --exclude=/.idea --exclude=/assets --exclude=/node_modules --exclude=/public/upload --exclude=/tests --exclude=/vendor --exclude=/var --exclude=.env --exclude=.env.local --exclude=.env.test --exclude=.env.test.local --exclude=.gitignore --exclude=.phpunit.result.cache --exclude=deploy.bat --exclude=phpunit.xml.dist --exclude=webpack.config.js --exclude=yarn.lock --exclude=yarn-error.log ./ u102390088@access845305565.webspace-data.io:~/sites/portfolio