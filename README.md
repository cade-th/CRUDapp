# Cade's CRUD Book Catalog

## Overview
This repository contains a book catalog management system developed using Vue.js for the frontend, PHP for the backend, MySQL as the database, and Docker for containerization. The system provides CRUD operations for managing a collection of books in a catalog. It is a demonstration of a full-stack, and containerized web application.

## Tech Stack
- **Frontend**: Vue.js
- **Backend**: PHP
- **Database**: MySQL
- **Containerization**: Docker

## Frontend
The frontend of the application is developed using Vue.js. It consists of several Vue components that handle different tasks including:

- Creating a new book entry
- Reading a book's details
- Updating an existing book
- Deleting a book from the catalog

Each CRUD action maps to a route in Vue that correspondeds to doing a CRUD action on from the frontend, to the backend, and finally to the database

## Three.js Integration:

This is one of the coolest parts of the app for me. I programmed a simple API for rendering 3D objects with textures mapped to them, and the result is a spinning 3D sphere the stays on the screen which I think is very dope.

I ran into a ton of problems wrestling with Vue to integrate three.js properly, espeically with trying to understand the backbone of three's api, but with a lot of googling I eventually got it to work

## Backend
The backend of the application is developed in PHP, providing a RESTful API that handles HTTP requests from the frontend. It communicates with a MySQL database to store and retrieve book data.

The php api is also run ontop an apache server as to provide maximum modularity to the project (which I elaborate on more below)

It delivers data in the form of JSON and is a single file because I was worried about not having enough time to finish the rest of the project, so I just made a very barebones , vanilla php api which I think was a good exercise anyway

## Database
The application uses a MySQL database to store book details. 

It is contained within its own server as well only is only a single sql file for the only table I need for this CRUD app

## Containerization with Docker
To ease the deployment and ensure environment consistency, the application is containerized using Docker. A `Dockerfile` is provided for the frontend, backend, and the database, which are combined using a `docker-compose.yml` file to orchestrate the multi-container application.

This is probably the best part of the whole project. Because the frontend, backend, and database are containerized into three servers that operate independently of each other, the entire project is incredibly modular and can be debugged super easy (as far as my knowledge goes because this was the best way of doing it wiht my previous linux/docker/apache knowledge)

## Development Process

Did everything in VS code on my arch linux box. 

The process went pretty much like this:

1. Got a basic php API running on apache inside a docker container that was just hello world
2. Got a basic MySQL server running on a docker image pulled from dockerhub
3. Wrote the sql.init file you can see in my code which setup a simple table that had all the attributes necessary for a book catalog
4. Wrote the docker-compose.yml file and the dockerfile for the api (the api one needed to install sql on its debian system). The docker-compose script proved to be one of the most challenging portions of this project, as its pretty much the link between all aspects of the project. It has a weird syntax but is such an amazing way of containerizing full stack web applications
5. Started up the servers with the compose file and attempted queries to the database with curl on my local machine. It didn't work and continued to not work for like 7 hours until I banged my head against a wall the entire time and figured out how to network individual docker containers which was a joy
6. Eventually I had all 4 CRUD operations working with curl after seeing the appropriate JSON data
7. With the backend figured out, I begain the front-end with a hello world Vue.js app. 
8. I then added App.vue, main.js, store.js (for Vuex which handled the little state management I needed for the different routes)
9. I decided on five routes, one fo reach CRUD operation and one to display all books to the user. Each route was a vue component, and would only render a form for the CRUD operation on top of the basic page layout (navbar, three js sphere, etc)
10. I also needed a component for three js that would be included in App.vue, but that was kinda a nightmare to figure out at first so I put it off for later
11. Once I had routing setup and all my pages navigated correctly with the home UI still rendering, I moved on the making simple html forms and buttons to represent the CRUD operatiosn for each route
12. I then had the brain tearing task of connecting the front end to the backend, which involved dockerizing the vue app and incorporating it into the docker-compose.yml file (which was more networking stuff that gave me a headache). Then I put boilerplate in each route to performing the corresponsing CRUD action according to the backend API.
13. I started to FINALLY get JSON data to the frontend, and could move on to formatting the website with some custom css styles that I found with a lot of googling and my own adjustment.
14. With the app basically setup and my brain flooded with dopamine, I went to beating the crap out of three js until decided to render a rotating green cube that didn't interfere with any of my other html elements. 6 hours later I then made a sphere instead, and wrapped it with a great texture.
15. The last 7ish hours or so of the project involved debugging the hell out of all this stuff and making sure my app ran on other machines besdies my arch linux machine
16. Then my brain forcefully shut-off as it seemed to have rebelled against rest of the body.


## Instructions to Run the Application

1. Install Docker and Docker Compose on your system.

2. Clone this repository.

3. Navigate into the repository directory.

4. Use Docker Compose to build and run the application.


5. The application should be accessible at `http://localhost:8082`.

Please note that the application might take a while to start, especially for the first time, as Docker needs to download the necessary images and build the containers.

## Future Improvements

1. I'm not a UI designer so there are probably a ton of things that could be improved in terms of the front end. I have a lot of edgecases in terms of rendering that I didn't take into account, and pretty much none of my forms have edge cases handling.

2. Defintley could be cooler use of three.js on the UI, and I tried to make it interactive but was constrained by the time limit.

3. The php api is still kinda basic and I should use a proper php framework like Laravel. 

4. I could add more tables in the database, becauase right now its as simple as it gets with no relations or anything reall besides what I needed for CRUD

5. I have literally zero security setup of any kind, but this is dockerized and I'm not deploying it to a cloud (yet) so maybe I will get to that






