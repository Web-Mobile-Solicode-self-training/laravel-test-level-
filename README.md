---
marp: true
mermaid: true
theme: default
paginate: true
backgroundColor: #fff
header: '📊 Goals Tracker Project'
footer: 'Réalisé par Abdelhay Mallouli'
style: |
  section {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }
  img {
    display: block;
    margin: 0 auto;
    border-radius: 8px;
  }

---

# Projet technique

## Goals Tracker Website (Suivi des Objectifs)

**Réalisé par :**
**MALLOULI Abdelhay**

**Encadré par :**
**M. ESSARRAJ Fouad**

---

# Contexte du projet

* Projet pour appliquer les connaissances acquises
* Suivi des objectifs personnels ou professionnels
* Méthodologie **2TUP** :

  * Fonctionnelle
  * Technique
  * Réalisation
* Préparation pour une **démonstration live**
---
<img src="imgs/2tup.png" alt="2TUP Methodology" style="width:45%;" />

---
# watterfall 

<img src="imgs/Waterfall_model.png" alt="Watterfall Methodology" style="width:45%;" />
---

# Analyse technique

## Technologies utilisées

1. Base de données : **MySQL**
2. Architecture : **N-Tiers**
3. Framework : **Laravel 12**
4. Architecture logicielle : **MVC**
5. Moteur de vues : **Blade**
6. **AJAX**
7. Upload d’images
8. **Laravel Multilangue**
---
9. **Vite**
10. **Preline UI Library**
11. **Lucide Icons Library**

---

# Analyse Fonctionnelle

## Cas d'utilisation

<img src="imgs/cas Dutilisation/cas.png" alt="Cas d'utilisation public" style="width:50%; margin-top:10px;" />

---

# Conception

## Diagramme de Classes

```mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +string password
    }

    class Goal {
        +int id
        +string title
        +string description
        +string status
        +int progress
        +string image
        +int user_id
    }

    class Category {
        +int id
        +string name
    }



    User "1" --> "0..*" Goal : crée
    Goal "0..*" -- "0..*" Category : appartient à

```

---

# Sujet – Live Coding

* Bouton **« Ajouter »** ouvrant une **modale** pour créer un nouvel objectif
* **Barre de recherche** filtrant les objectifs par **titre**
* Mise à jour dynamique avec **AJAX**

---

## Versions

| Version | Description | Branche |
| :--- | :--- | :--- |
| **v1** | Public Side (Consultation, Recherche, Filtre) | `public` |
| **v2** | Admin Side (CRUD, Modales) | `admin` |
| **v3** | Authentification / Authorization (Gates) | `gates` |
| **v4** | SPA / AJAX | `spa-ajax` |
| **v5** | SPA / Alpine.js | `spa-alpine` |
| **v6** | Spatie / Authorization | `spatie` |
| **v7** | API | `api` |
| **v8** | Mobile App | `mobile` |

---

## **v1** : Public Side

* **Live Coding :** Création du portfolio personnel

---

## **v2** : Admin Side

* **Live Coding :** Gestion des articles (CRUD)

---

## **v3** : Authentification / Authorization

* **Live Coding :** 

---

## **v4** : SPA / AJAX

* **Live Coding :** 
  - Bouton “Ajouter” via modale
  - Barre de recherche dynamique

---

## **v5** : SPA / Alpine.js

* **Live Coding :** 

---

## **v6** : Spatie / Authorization

* **Live Coding :**

---

## **v7** : API

* **Live Coding :** 

---

## **v8** : Mobile App

* **Live Coding :** 
---