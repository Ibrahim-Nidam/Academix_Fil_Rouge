# Academix_Fil_Rouge

**Academix : Optimizing workflows to elevate performance and organization.**

**Project Supervisor:** Iliass RAIHANI.

**Author:** Ibrahim Nidam.

## Links

- **Link For all:** [View all Links](https://linktr.ee/File_Rouge);
- **Live Application Link :** [View Live Application](https://academix-main-i48wzd.laravel.cloud/)
- **Cahier Charge Link :** [View Cahier Charge](https://docs.google.com/document/d/1pBDmOu85xV_cRApyiOfCaoxyoeNwIs5aZCUvQey0KdU/edit?usp=sharing)
- **Presentation Link :** [View Presentation](https://www.canva.com/design/DAGaGEgqC3U/US-EUtYLaKpGtz_Kn2ezQw/view?utm_content=DAGaGEgqC3U&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=h588869fb5c)
- **UML USE CASE Link :** [View UML USE CASE](https://asset.cloudinary.com/dgrkuq5an/7b97c5c643e4d956e4398ae52ba1ebdd)
- **UML CLASS DIAGRAM Link :** [View UML CLASS DIAGRAM](https://lucid.app/lucidchart/47300f7f-4625-486c-89b8-8c6ca26a2178/edit?invitationId=inv_d655986b-27a8-4346-8d76-18e74ce7cdba&page=0_0#)
- **Figma Link :** [View Figma](https://www.figma.com/design/bLfsYySlB110VscKWNOehD/Academix---Fil-Rouge?node-id=0-1&t=JhfkdNaRrkCyHKO0-1)
- **Color Palette Link :** [View Colors](https://coolors.co/0d1321-1f2937-4b5563-d4af37-f3f4f6)
- **Backlog Link :** [View on Backlog](https://github.com/users/Ibrahim-Nidam/projects/3/views/1)
- **GitHub Repository Link :** [View on GitHub](https://github.com/Ibrahim-Nidam/Academix_Fil_Rouge.git)
- **UML Diagrams:** [View in public/UML]()
___
### COLOR PALLETE:
![Diagram](public/PALLETE/palette.svg)


### Créé : 21/12/24

Le système actuel de gestion des élèves, des enseignants, des étudiants est fragmenté. Le but est de centraliser et d'automatiser les processus pour améliorer l'efficacité et la communication au sein de l'école.

# Configuration et Exécution du Projet Laravel

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants :

- **PHP** (à partir de la version recommandée par Laravel, voir [PHP](https://www.php.net/)).
- **Composer** ([télécharger ici](https://getcomposer.org/download/)).
- **Node.js** et **npm** ([télécharger ici](https://nodejs.org/)).

## Installation du projet

### 1. Cloner le dépôt

Ouvrez un terminal et exécutez :
```bash
git clone https://github.com/Ibrahim-Nidam/Academix_Fil_Rouge.git
cd Academix_Fil_Rouge
```

### 2. Installer les dépendances PHP

Dans le dossier du projet, exécutez :
```bash
composer install
```

### 3. Configurer le fichier `.env`

Copiez le fichier `.env.example` et renommez-le en `.env` :
```bash
cp .env.example .env  # Linux/Mac
copy .env.example .env # Windows
```

Modifiez les paramètres de la base de données dans `.env` :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

### 4. Générer la clé d'application

Exécutez la commande suivante pour générer une clé unique :
```bash
php artisan key:generate
```

### 5. Exécuter les migrations et seeders (si disponibles)

Créez la base de données et appliquez les migrations :
```bash
php artisan migrate --seed
```

### 6. Installer les dépendances front-end

Installez les dépendances npm :
```bash
npm install
```
Si votre projet utilise Vite, démarrez le build :
```bash
npm run dev
```

### 7. Démarrer le serveur local

Utilisez la commande artisan pour démarrer le serveur Laravel :
```bash
php artisan serve
```
Accédez au projet via : [http://127.0.0.1:8000](http://127.0.0.1:8000)


## Contexte du projet:

- **Objectif principal :** Développer une application web permettant à différents utilisateurs (administrateurs, enseignants, étudiants) de gérer et suivre les informations scolaires de manière centralisée et efficace.

## Périmètre du Projet
### Utilisateurs cibles :

- Administrateur (Directeur de l'école)
- Enseignants
- Étudiants

### Modules principaux :
- Gestion des utilisateurs (enseignants, étudiants)
- Gestion des emplois du temps et des ressources
- Suivi des performances des étudiants
- Affichage des statistiques

## Fonctionnalités par Rôle

### 1 Rôle : Administrateur (Directeur de l'école)

- **User Story 1 :** Importation de comptes via Excel
En tant qu'administrateur (Directeur de l'école), je souhaite importer un fichier Excel contenant les informations des enseignants et étudiants  afin de créer ou mettre à jour les comptes en masse.
- **User Story 2  :** Prévisualisation et validation avant importation
En tant qu'administrateur, je souhaite prévisualiser les données extraites du fichier Excel et valider leur exactitude avant de procéder à l'importation.
- **User Story 3 :** Consultation des statistiques d'assiduité et de performance
En tant qu'administrateur, je souhaite consulter les statistiques d'assiduité des enseignants et des étudiants ainsi que les performances académiques afin de suivre leur évolution.
- **User Story 4 :** Génération de rapports statistiques
En tant qu'administrateur, je souhaite générer des rapports récapitulatifs des statistiques (assiduité, performances) afin d'analyser les opérations et prendre des décisions éclairées.
### 2 Rôle : Enseignant

- **User Story 1 :** Consultation des classes
 En tant qu'enseignant, je souhaite afficher la liste des classes que j’enseigne.
- **User Story 2 :** Consultation de l'emploi du temps
 En tant qu'enseignant, je souhaite consulter mon emploi du temps hebdomadaire.
- **User Story 3 :** Ajout de ressources pédagogiques
 En tant qu'enseignant, je souhaite ajouter des documents, vidéos et autres supports à mes leçons afin d’enrichir l'expérience d'apprentissage des étudiants.
- **User Story 4 :** Enregistrement de la présence
 En tant qu'enseignant, je souhaite enregistrer la présence des étudiants lors de chaque cours afin de suivre leur assiduité.
- **User Story 5 :** Historique d’assiduité
 En tant qu'enseignant, je souhaite consulter un historique des présences.
- **User Story 6 :** Saisie et modification des notes
 En tant qu'enseignant, je souhaite saisir et modifier les notes des étudiants afin d’évaluer et suivre leurs performances académiques.
- **User Story 7 :** Consultation de l’historique des évaluations
 En tant qu'enseignant, je souhaite consulter l’historique des notes attribuées afin d’analyser l’évolution des performances de mes étudiants.
- **User Story 8 :** Consultation des statistiques générales
 En tant qu'enseignant, je souhaite consulter les statistiques de la classe (moyenne des notes) afin d’identifier les points forts et les axes d’amélioration.

### 3 Rôle : Étudiant

- **User Story 1 :** Visualisation de l'emploi du temps
En tant qu'étudiant, je souhaite consulter mon emploi du temps hebdomadaire afin d'organiser mes journées et mes révisions.
- **User Story 2 :** Consultation de mes performances
En tant qu'étudiant, je souhaite consulter mes notes afin de suivre mes performances scolaires et identifier mes axes d'amélioration.
- **User Story 3 :** Suivi de mon assiduité
En tant qu'étudiant, je souhaite consulter mon assiduité, afin de m'assurer que mon engagement est correctement suivi.
- **User Story 4 :** Accès aux ressources de la classe
En tant qu'étudiant, je souhaite télécharger et consulter les ressources pédagogiques (documents, vidéos, etc.) mises à disposition par mes enseignants afin de renforcer mon apprentissage.
- **User Story 5 :** Visualisation des commentaires sur mes notes
En tant qu'étudiant, je souhaite voir les commentaires des enseignants sur mes notes afin de mieux comprendre mes points forts et mes axes de progression.

## **Modalités pédagogiques**

- Travail: Individuel.
    -  Date de lancement de brief : 12/12/2024 à 09 :30
    -  Date limite de soumission: 05/05/2025

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
