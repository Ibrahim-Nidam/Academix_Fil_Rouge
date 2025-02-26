# Academix_Fil_Rouge

**Academix : Optimizing workflows to elevate performance and organization.**

**Project Supervisor:** Iliass RAIHANI.

**Author:** Ibrahim Nidam.

### Créé : 21/12/24

## License

This project is proprietary and confidential. All rights reserved. Unauthorized copying, modification, distribution, or use of this software is strictly prohibited.

For permissions or inquiries, please contact:
**Ibrahim Nidam** at **ibrahim.nidam22@gmail.com**.

## Links

- **Cahier Charge Link :** [View Cahier Charge](https://docs.google.com/document/d/1pBDmOu85xV_cRApyiOfCaoxyoeNwIs5aZCUvQey0KdU/edit?tab=t.0)
- **Presentation Link :** [View Presentation](https://www.canva.com/design/DAGaGEgqC3U/US-EUtYLaKpGtz_Kn2ezQw/view?utm_content=DAGaGEgqC3U&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=h588869fb5c)
- **UML USE CASE Link :** [View UML USE CASE](https://lucid.app/lucidchart/dc4e4f89-5ecd-4692-937e-75bcdec76b33/edit?viewport_loc=-11%2C-11%2C1629%2C808%2C0_0&invitationId=inv_c3a5750e-1574-4ab5-b14f-5097e0b453a1)
- **UML CLASS DIAGRAM Link :** [View UML CLASS DIAGRAM](https://lucid.app/lucidchart/47300f7f-4625-486c-89b8-8c6ca26a2178/edit?viewport_loc=-1197%2C-11%2C1629%2C808%2C0_0&invitationId=inv_d655986b-27a8-4346-8d76-18e74ce7cdba)
- **Figma Link :** [View Figma](https://www.figma.com/design/jhM4tVSxYdO0INOTeB1eUA/Fil-Rouge-%3A-Low%2FHigh-fidelity-%2B-Prototype?node-id=2-3&t=esY8Q5E2aJBqKwW6-1)
- **Backlog Link :** [View on Backlog]()
- **GitHub Repository Link :** [View on GitHub](https://github.com/Ibrahim-Nidam/Academix_Fil_Rouge.git)

## Configuration et Exécution du Projet

#### Prérequis
- **Node.js** et **npm** installés (téléchargez [Node.js](https://nodejs.org/)).
- **Laragon** installé (téléchargez [Laragon](https://laragon.org/download/)).
- **PHP** installé et ajouté au PATH (Environnement système).

#### Étapes d’installation

1. **Cloner le projet** :
   - Ouvrir un terminal et exécuter :  
     ```bash
     git clone https://github.com/Ibrahim-Nidam/Academix_Fil_Rouge.git
     ```

2. **Placer le projet dans le dossier Laragon** :
   - Cliquez sur le bouton **Root** dans Laragon pour ouvrir le dossier `www` (par défaut, `C:\laragon\www`).
   - Le chemin de votre projet devrait être `C:\laragon\www\Academix_Fil_Rouge`.

3. **Configurer la base de données** :
   - Faites un clic droit sur **Laragon**, puis allez dans **Tools** > **Quick Add** et téléchargez **phpMyAdmin** et **MySQL**.
   - Ouvrir **phpMyAdmin** via Laragon :
     - Dans Laragon, cliquez sur le bouton **Database** pour accéder à phpMyAdmin (username = `root` et mot de passe est vide).
     - Créez une base de données `academix_db` et importez le fichier `script.sql` (disponible dans le dossier `/database/`).

4. **Installer les dépendances Node.js** :
   - Ouvrez un terminal dans le dossier du projet cloné.
   - Exécutez :  
     ```bash
     npm install
     ```

5. **Télécharger l'installateur de Composer :**  
  - Rendez-vous sur [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe) pour télécharger l'installateur pour Windows.

- **Exécuter l'installateur :**  
  - Double-cliquez sur le fichier `Composer-Setup.exe` téléchargé.  
  - Suivez les instructions à l'écran :  
    - Assurez-vous que PHP est déjà installé et disponible dans le PATH de votre système. Sinon, ajoutez le chemin vers `php.exe` lors de l'installation.  
    - L'installateur configurera automatiquement la variable d'environnement PATH pour Composer.


   **Alternative :**
   Ouvrez un terminal dans le dossier du projet cloné et exécutez les commandes suivantes :
   ```cmd
   REM Télécharger l'installateur Composer
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

   REM Vérifier le hash SHA-384 de l'installateur
   php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') echo Installer verified && exit; echo Installer corrupt && del composer-setup.php && exit /b 1"

   REM Exécuter l'installateur
   php composer-setup.php

   REM Supprimer le script d'installation
   php -r "unlink('composer-setup.php');"

   REM Déplacer composer.phar dans un répertoire du PATH (optionnel pour un usage global)
   move composer.phar C:\bin\composer.phar
   ```
   Ajoutez le dossier `C:\bin` à votre variable d'environnement PATH pour utiliser Composer globalement.

6. **Initialiser Composer dans le projet** :
   - Dans le dossier racine du projet, exécutez :
     ```bash
     composer init
     ```
   - Suivez les instructions pour générer un fichier `composer.json` et acceptez `psr-4`.

7. **Installer les dépendances PHP** :
   - Une fois le fichier `composer.json` généré, exécutez :
     ```bash
     composer install
     ```

8. **Configurer le fichier `.env`** :
   - Copiez le fichier `.env.example` en `.env` :
     ```bash
     cp .env.example .env
     ```
   - Modifiez les paramètres de la base de données dans le fichier `.env` pour correspondre à votre configuration :
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=academix_db
     DB_USERNAME=root
     DB_PASSWORD=
     ```

9. **Générer la clé de l’application** :
   - Exécutez la commande suivante dans le terminal :
     ```bash
     php artisan key:generate
     ```

10. **Migrer les tables de la base de données** :
    - Lancez les migrations avec :
      ```bash
      php artisan migrate
      ```

11. **Exécuter le projet localement** :
    - Lancez le serveur de développement Laravel avec :
      ```bash
      php artisan serve
      ```
    - Accédez à l’application via `http://127.0.0.1:8000`.

## Contexte du projet:

- **Contexte :** Le système actuel de gestion des élèves, des enseignants, des parents et des étudiants est fragmenté. Le but est de centraliser et d'automatiser les processus pour améliorer l'efficacité et la communication au sein de l'école.

- **Objectif principal :** Développer une application web permettant à différents utilisateurs (administrateurs, enseignants, parents, étudiants) de gérer et suivre les informations scolaires de manière centralisée et efficace.

## Périmètre du Projet
### Utilisateurs cibles :

- Administrateur (Directeur de l'école)
- Enseignants
- Parents
- Étudiants

### Modules principaux :
- Gestion des utilisateurs (enseignants, étudiants, parents)
- Gestion des emplois du temps et des ressources
- Suivi des performances des étudiants
- Communication entre les différents acteurs
- Affichage des statistiques

## Fonctionnalités par Rôle

### 1 Rôle : Administrateur (Directeur de l'école)

**Gestion des utilisateurs :**
- Créer, lire, mettre à jour et supprimer (CRUD) les profils des enseignants, des étudiants et des parents.
- Assigner des rôles (enseignant, parent, étudiant).
- Approuver les parents après inscription.

**Affichage des statistiques :**
- Consulter les statistiques d'assiduité des enseignants et des étudiants.
- Suivre les performances des étudiants (notes et progrès) via des données affichées dans l'application.

### 2 Rôle : Enseignant

**Gestion des classes :**
- Créer, lire, mettre à jour et supprimer (CRUD) les informations relatives aux classes.

**Emploi du temps :**
- Voir l'emploi du temps de la semaine.

**Planification des leçons :**
- Programmer des leçons et ajouter des ressources (documents, vidéos, etc.).

**Gestion de la présence :**
- Enregistrer et suivre la présence des étudiants.

**Gestion des notes :**
- Ajouter des notes pour les étudiants.

**Statistiques de la classe :**
- Consulter les statistiques de la classe (moyenne des notes, assiduité, etc.) affichées directement dans l'application.

### 3 Rôle : Parent

**Suivi des performances de l'enfant :**
- Voir les notes des enfants.
- Définir un seuil de note minimum pour être notifié lorsque la note d'une matière est inférieure à ce seuil.

**Suivi de la présence :**
- Voir l'assiduité des enfants (présences et absences justifiées).

**Communication avec l'enseignant :**
- Envoyer des messages aux enseignants.
- Recevoir des messages des enseignants.

### 4 Rôle : Étudiant

**Emploi du temps :**
- Voir l'emploi du temps de la semaine.

**Suivi des performances :**
- Voir ses propres notes.

**Suivi de la présence :**
- Voir son assiduité (présences et absences justifiées).

**Accès aux ressources de la classe :**
- Télécharger les ressources de la classe (documents, vidéos, etc.).

**Commentaires sur les notes :**
- Voir les commentaires des enseignants sur les notes.

## **Modalités pédagogiques**

- Travail: Individuel.
    - ⏳ Date de lancement de brief : 12/12/2024 à 09 :30
    - ⏳ Date limite de soumission: 05/05/2025

## **Modalités d'évaluation**
- Pour défendre votre travail devant un jury, vous devrez présenter individuellement votre projet en 45 minutes. Vous devrez démontrer l'application web en montrant le code source et en expliquant brièvement comment il fonctionne, et montrer que le code est valide aussi pour les livrables demandés.

- Pour une présentation efficace, il est conseillé de bien vous préparer pour montrer le plus de votre travail en un minimum de temps. Il est également recommandé d'ouvrir toutes les ressources du projet à l'avance pour gagner du temps, comme ouvrir votre site dans un navigateur ou montrer les journaux de commit sur votre dépôt. Il est important d'être strict dans le timing de votre présentation.

## **Livrables**

Un lien GitHub d'un Dossier que va contenir Les éléments suivants :

- Cahier de Charges (User Stories)
- Maquette
- Conception
- Implémentation de l'application
- Présentation du Projet
- Scrum Board

**Dossier Principal :** 
- Dossier de Cahier de Charges
    - Fichier README.md

- Dossier de Conception  
    - Diagrammes UML (Use Case, Classes, Séquences ...)

- Dossier de Maquette  
    - Maquette Desktop
    - Maquette Mobile
    - Fichier Source de la maquette (AdobeXD) avec prototype ou Fichier texte contenant le lien vers une version en ligne (Figma, Framer...)

- Dossier de Présentation
    - Présentation.pptx ou Fichier texte contenant le lien vers une version en ligne (Canva...)

N.B : Les livrables doit être disponibles sur GitHub aussi que le code source.

## **Critères de performance**

 Il est important que le site web soit facilement accessible et s'adapte à différents types d'écrans et de tailles d'affichage, c'est-à-dire qu'il soit "responsif". Cela garantit une expérience utilisateur optimale pour tous les visiteurs, qu'ils utilisent un ordinateur de bureau, un ordinateur portable, une tablette ou un smartphone pour accéder au site.

Il est crucial que l'application web soit sûre et que le code soit propre en respectant les bonnes pratiques de développement telles que les principes DRY (Don't Repeat Yourself) et KISS (Keep It Simple, Stupid). Cela garantit une application fiable et facile à maintenir, ainsi qu'une réduction des risques de sécurité liés à des erreurs de code ou à des codes redondants.