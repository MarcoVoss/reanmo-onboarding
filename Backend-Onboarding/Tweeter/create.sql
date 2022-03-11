drop database if exists tweeter;

create database tweeter;

create table tweeter.Users (
    id int,
    name varchar(255),
    lastname varchar(255),
    mail varchar(255),
    img blob,
    pw varchar(255),
    PRIMARY KEY (id)
);

create table tweeter.Tweets (
    id int,
    user_id int,
    msg text,
    date date,
    img blob,
    PRIMARY KEY (id),
    FOREIGN KEY(user_id) REFERENCES tweeter.Users(id)
);

create table tweeter.TweetLikes (
    tweet_id int,
    user_id int,
    PRIMARY KEY (tweet_id, user_id),
    FOREIGN KEY (tweet_id) REFERENCES tweeter.Tweets(id),
    FOREIGN KEY (user_id) REFERENCES tweeter.Users(id)
);

create table tweeter.Comments (
    id int,
    tweet_id int,
    user_id int,
    msg text,
    PRIMARY KEY (id),
    FOREIGN KEY (tweet_id) REFERENCES tweeter.Tweets(id),
    FOREIGN KEY (user_id) REFERENCES tweeter.Users(id)
);

create table tweeter.CommentLikes (
    comment_id int,
    user_id int,
    PRIMARY KEY (comment_id, user_id),
    FOREIGN KEY (user_id) REFERENCES tweeter.Users(id),
    FOREIGN KEY (comment_id) REFERENCES tweeter.Comments(id)
);

create table tweeter.Followers (
    user_id int,
    follower_id int,
    PRIMARY KEY (user_id, follower_id),
    FOREIGN KEY (user_id) REFERENCES tweeter.Users(id),
    FOREIGN KEY (follower_id) REFERENCES tweeter.Users(id)
);