# Project 2, Milestone 1 - Design & Plan

Your Name: Aileen Cai

## 1. Persona

I've selected **[Abby]** as my persona.

I've selected my persona because... [Tell us why you picked your persona in 1-3 sentences.]

I've selected my persona because her motivations and attitudes toward technology is parallel to mine. My information processing style is also "burst-y" so I feel that our similarities would help me design a webpage that would be more user friendly to her.

## 2.Describe your Catalog

[What will your collection be about? What types of attributes (database columns) will you keep track of for the *things* in your collection? 1-2 sentences.]

My collection will include a list of movies that the user wants to see. My columns would consist of movie images, movie titles, reviews, genre and ratings.

## 3. Sketch & Wireframe

[Insert your 1 sketch here.]
![](Scan.jpg)

[Insert your 1 wireframe here.]
![](Scan1.jpg)

[Explain why your design would be effective for your persona. 1-3 sentences.]
My sketches meet the need of my personal because it is simple and intuitive. Since Abby is risk averse and has low confidence about doing unfamiliar tasks, I decided to place the search bar at the top of the home page only because it contains the list. I will also include a header (Results for "PG") so the user knows that this is the filtered list.

## 4. Database Schema Design

[Describe the structure of your database. You may use words or a picture. A bulleted list is probably the simplest way to do this.]

Table: movies
* field 1: movie img
* field 2: title
* field 3: reviews
* field 4: genre
* field 5: ratings

## 5. Database Query Plan

[Plan your database queries. You may use natural language, pseudocode, or SQL.]

1. All records

SQL: SELECT * FROM movies;


2. Search records by user selected field

Search the columns: title, reviews etc. with the user input.

SQL: "SELECT * FROM movies WHERE "columns" LIKE '%' || :search || '%'";


3. Insert record

SQL: INSERT INTO movies (movie_img, title, reviews, genre, ratings)

## 6. *Filter Input, Escape Output* Plan

[Describe your plan for filtering the input from your HTML forms. Describe your plan for escaping any values that you use in HTML or SQL. You may use natural language and/or pseudocode.]

I will check user input by filtering it and escaping output.
ex: $movie_title = filter_input(INPUT_POST, "movie_title", FILTER_SANITIZE_STRING);
I need to make sure it is a string and not number values or special chars.
Some of my text fields will be drop down menus so that the user will not input incorrect information. Ratings will also have a drop down menu because some users might think it means something else. I will check for strings in the rest of my inputs (genre and title).

In the escape output portion, I will have a htmlspecialchars() method to only allow alphabetic characters or numbers. All of the other fields will be regulated with dropdown menus so that users will not input characters that do not belong in that field.

## 7. Additional Code Planning

[If you need more code planning that didn't fit into the above sections, put it here.]
