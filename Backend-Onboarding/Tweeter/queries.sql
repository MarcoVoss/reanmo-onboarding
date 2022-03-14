-- Alle Tweets von leuten denen User 1 folgt
SELECT * 
FROM tweeter.Followers as f
RIGHT JOIN tweeter.Tweets as t ON t.user_id = f.follower_id
WHERE f.user_id = 1

-- Für alle diese Tweets:  (Text, Autor, Bild, Anzahl Likes, Like Status für User 1, Anzahl Kommentare)
SELECT t.msg as Text, u.name as Name, t.img as Bild, 
     EXISTS (
        SELECT user_id 
        FROM TweetLikes as tl 
        WHERE tl.tweet_id = t.id and tl.user_id = f.user_id
    ) as Status, (
        SELECT COUNT(*) 
        FROM TweetLikes as tl
        WHERE tl.tweet_id = t.id
    ) as Likes
FROM tweeter.Followers as f
RIGHT JOIN tweeter.Tweets as t ON t.user_id = f.follower_id
LEFT JOIN tweeter.Users as u ON t.user_id = u.id
WHERE f.user_id = 1

-- Alle Tweets, die der 1. User liked
SELECT t.id, t.msg, t.date
FROM tweeter.TweetLikes as tl
LEFT JOIN tweeter.Tweets as t ON tl.tweet_id = t.id
WHERE tl.user_id = 1

-- Alle Tweets bei denen Autor = Kommentator
SELECT * 
FROM tweeter.Tweets as t
WHERE EXISTS (
    SELECT * 
    FROM tweeter.Comments as c
    WHERE c.tweet_id = t.id and t.user_id = c.user_id
)