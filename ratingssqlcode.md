CREATE TABLE ratings (id INTEGER PRIMARY KEY AUTO_INCREMENT,   
    username VARCHAR(255),
    song VARCHAR(255),
    artist VARCHAR(255),
    rating VARCHAR(255));

#### insert this into the sql section of the ratings after executing the code above^

ALTER TABLE `ratings` ADD UNIQUE(`username`);
    
