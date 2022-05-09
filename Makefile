PHP_CMD = php
.DEFAULT_GOAL:=help
rebuild:

	@ echo "Instal·lant dependències..."
	-composer install -n

	@ echo "Esborrant la base de dades..."
	-$(PHP_CMD) bin/console doctrine:database:drop -n --force

	@ echo "Creant-la de nous..."
	$(PHP_CMD) bin/console doctrine:database:create -n

	@ echo "Creant l'estructura..."
	$(PHP_CMD) bin/console doctrine:migrations:migrate -n

	@ echo "Esborrant i creant el directori si no existeix.."
	#-rm -rf public/fotos-web/fixtures
	#-mkdir -p public/fotos-web/fixtures
	# chmod 777 -R public/fotos-web/fixtures+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


	@ echo "Carregant les dades..."
	$(PHP_CMD) bin/console doctrine:fixtures:load -n

help:
	@ echo "Utilitza 'make rebuild' per a regenerar les dades"