INSERT INTO tweeter.Users VALUES(1, 'Marco', 'Voss', 'm.v@gmx.de', null, '1234');
INSERT INTO tweeter.Users VALUES(2, 'Rüdiger', 'Boss', 'r.b@gmx.de', null, '5678');
INSERT INTO tweeter.Users VALUES(3, 'Horst', 'Muss', 'h.m@gmx.de', null, '1234');
INSERT INTO tweeter.Users VALUES(4, 'Thorsten', 'Schuss', 't.s@gmx.de', null, '9012');

INSERT INTO tweeter.Tweets VALUES(1, 1, 'Viel Text', '2022-01-01', null);
INSERT INTO tweeter.Tweets VALUES(2, 1, 'Noch mehr Text', '2021-01-05', null);
INSERT INTO tweeter.Tweets VALUES(3, 2, 'Eigentlich nix', '2022-03-01', null);
INSERT INTO tweeter.Tweets VALUES(4, 3, 'Ist was?', '2021-08-09', null);

INSERT INTO tweeter.TweetLikes VALUES(1, 1);
INSERT INTO tweeter.TweetLikes VALUES(1, 2);
INSERT INTO tweeter.TweetLikes VALUES(2, 4);
INSERT INTO tweeter.TweetLikes VALUES(3, 1);

INSERT INTO tweeter.Comments VALUES(1, 1, 1, 'SELBER');
INSERT INTO tweeter.Comments VALUES(2, 2, 3, 'A');
INSERT INTO tweeter.Comments VALUES(3, 3, 2, 'GEH');
INSERT INTO tweeter.Comments VALUES(4, 1, 2, 'WAS');

INSERT INTO tweeter.CommentLikes VALUES(1, 1);
INSERT INTO tweeter.CommentLikes VALUES(2, 1);
INSERT INTO tweeter.CommentLikes VALUES(2, 2);
INSERT INTO tweeter.CommentLikes VALUES(4, 3);

INSERT INTO tweeter.Followers VALUES(1, 2);
INSERT INTO tweeter.Followers VALUES(1, 3);
INSERT INTO tweeter.Followers VALUES(1, 4);
INSERT INTO tweeter.Followers VALUES(2, 3);
