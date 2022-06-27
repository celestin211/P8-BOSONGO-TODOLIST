#OPENCLASSROOMS TodoList#
 
https://openclassrooms.com/fr/paths/59/projects/44/assignment
  
  
https://bosongotodolist.fr
                                                        
## Descriptif du besoin ##

Vous venez d’intégrer une startup dont le cœur de métier est une application permettant de gérer ses tâches quotidiennes. L’entreprise vient tout juste d’être montée, et l’application a dû être développée à toute vitesse pour permettre de montrer à de potentiels investisseurs que le concept est viable (on parle de Minimum Viable Product ou MVP).

Le choix du développeur précédent a été d’utiliser le framework PHP Symfony, un framework que vous commencez à bien connaître !

Bonne nouvelle ! ToDo & Co a enfin réussi à lever des fonds pour permettre le développement de l’entreprise et surtout de l’application.

Votre rôle ici est donc d’améliorer la qualité de l’application. La qualité est un concept qui englobe bon nombre de sujets : on parle souvent de qualité de code, mais il y a également la qualité perçue par l’utilisateur de l’application ou encore la qualité perçue par les collaborateurs de l’entreprise, et enfin la qualité que vous percevez lorsqu’il vous faut travailler sur le projet.

Ainsi, pour ce dernier projet de spécialisation, vous êtes dans la peau d’un développeur expérimenté en charge des tâches suivantes :

l’implémentation de nouvelles fonctionnalités ;
la correction de quelques anomalies ;
et l’implémentation de tests automatisés.
Il vous est également demandé d’analyser le projet grâce à des outils vous permettant d’avoir une vision d’ensemble de la qualité du code et des différents axes de performance de l’application.

Il ne vous est pas demandé de corriger les points remontés par l’audit de qualité de code et de performance. Cela dit, si le temps vous le permet, ToDo & Co sera ravi que vous réduisiez la dette technique de cette application.
### Corrections de bogues ###

### Une tâche doit être attachée à un utilisateur ###

Actuellement, lorsqu'une tâche est créée, elle n'est pas rattachée à un utilisateur. Il vous est demandé d'apporter le
corrections nécessaires pour que automatiquement, lors de l'enregistrement de la tâche, l'utilisateur authentifié soit rattaché à
la tâche nouvellement créée.

Lors de la modification de la tâche, l'auteur ne peut pas être modifié.

Pour les tâches déjà créées, elles doivent être rattachées à un utilisateur « anonyme ».
Choisir un rôle pour un utilisateur

Lors de la création d'un utilisateur, il doit être possible de lui attribuer un rôle. Les rôles répertoriés sont
Suivant:

  - rôle d'utilisateur (ROLE_USER) ;
  - rôle d'administrateur (ROLE_ADMIN).

Lors de la modification d'un utilisateur, il est également possible de changer le rôle d'un utilisateur.

### Implémentation de nouvelles fonctionnalités ###

#### Autorisation ####

Seuls les utilisateurs ayant le rôle d'administrateur (ROLE_ADMIN) doivent pouvoir accéder aux pages de gestion de
utilisateurs.

Les tâches ne peuvent être supprimées que par les utilisateurs qui ont créé la tâche en question.

Les tâches attachées à l'utilisateur "anonyme" ne peuvent être supprimées que par les utilisateurs
rôle d'administrateur (ROLE_ADMIN).
#### Mise en place de tests automatisés ####

Vous êtes amené à mettre en place les tests automatisés (tests unitaires et fonctionnels) nécessaires pour vous assurer que
le fonctionnement de l'application est bien en adéquation avec les demandes.

Ces tests doivent être implémentés avec PHPUnit ; vous pouvez également utiliser Behat pour la partie fonctionnelle.

## Facilité ##

1. Clone le repo:
```
    git clone https://github.com/celestin211/P8-BOSONGO-TODOLIST
```

2. Editer the .env with your information.

3. Installer les dépendencies:
```
    composer install
```

4. Set up the database:
```
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
```
