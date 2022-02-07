# P5 - Projet de blog PHP

Ce projet a été réalisé dans le cadre de ma formation de développeur 
d'applications web PHP / Symfony chez OpenClassrooms.

## Installation

## Le projet

### 1. La demande
Pour faire court, il m'était demandé de réalisé : 
-   un portfolio qui me présente
-   un formulaire de contact
-   un système de blog
-   un système de comptes utilisateur qui peuvent avoir plusieurs rôles :
  -   **VISITEUR** (non connecté), il peut :
  
    <img alt="Visitor Usecase" src="docs\Images\Usecases\usecase-visitor.png"/>
  -   **UTILISATEUR**, il peut
  
    <img alt="Visitor Usecase" src="docs\Images\Usecases\usecase-user.png"/>
  -   **AUTEUR**, il peut :
  
    <img alt="Visitor Usecase" src="docs\Images\Usecases\usecase-author.png"/>
  -   **ADMINISTRATEUR**, il peut :
  
    <img alt="Visitor Usecase" src="docs\Images\Usecases\usecase-admin.png"/>

### 2. Les contraintes
Pour réaliser ce projet, j'ai eu quelques contraintes imposées :
-   Utilisation d'un thème Bootstrap
-   Possibilité d'utiliser des librairies Composer
-   Site responsive
-   Possibilité d'utiliser le moteur de templating Twig
-   Partie administration accessible qu'aux utilisateurs autorisés (admin et auteurs)
-   Protection contre les failles de sécurité (XSS, CSRF, SQL Injection, session hijacking, 
upload possible de script PHP…)
-   Projet accessible sur Github et commit en anglais
-   Organiser le projet sur Github avec des issues (de préférence en anglais) à compléter au fil 
du projet et estimer le temps pour chaque issue
-   Projet suivi par SymfonyInsight ou Codacy pour la qualité de code

### 3. Livrables demandés
Un certain nombre de livrables m'a été demandé pour valider ce projet :
-   lien vers le projet Giothub
-   instruction pour installer le projet dans le fichier REAMDE.md
-   schémas UML dans une dossier nommé "diagrammes" à la racine du projet
-   Les issues que j'ai créé
  -   Un lien vers la dernière analyse SymfonyInsight / Codacy