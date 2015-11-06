# NTUBAGB Website Guide
## Introduction

This is the website made for NTUBAGB for the use of collecting information of videos, pictures, and data. The purpose of this ducumentation is to help someone whoever is in charge of managing this website do his or her work done.

> This guide is for those who has no background in coding.

## Table of Contents

1. [Introduction](#introduction)
2. [Table of Contents](#table-of-contents)
3. [Basic Tools](#basic-tools)
4. [Get the Source Code](#get-the-source-code)
3. [Mainpage Editing](#mainpage-editing)
4. [Data Management](#data-management)
5. [Statistic Data Management](#statistic-data-management)
5. [Make it Better](#make-it-better)

## Basic Tools

To manage this website you will need a web server and a text editor. In this guide we will use XAMPP and sublime text. If you prefer other web server or other editor, it is up to you.

### XAMPP

XAMPP is a develope environment which set up all the things for you. Here you don't need to know what it is. Just click [here](https://www.apachefriends.org/zh_tw/index.html) to install .

> There will be a bunch of stuff that could be installed but here we only need the **Apache Web Server**. So unclick all the other stuff like mariaDB, proFTPD etc.

When you are finished. Double click `/Applications/XAMPP/xamppfiles/manage-osx` and you will see a manage board (type your user password if needed). Then find Apache Web Server and start it.

> It is important to make sure the server is running every time you want to manage this website.

Now open your web browser and type `localhost`. See if you see a veiw of XAMPP. If you do, Congratulations! You have installed it correctly.

### FileZilla

FileZilla is for you to upload data to the server. The website can only be seen if you upload it to the sever side. In this case, I suppose you are using the server which NTU provides. There already exists a guide about installation and furthere settings. Click [here](http://www.cc.ntu.edu.tw/chinese/services/serv_i01.asp) and make sure you follow all the guides inside.

### Sublime Text

It is not a necessary to use Sublime Text to edit. Any editor like TextEdit can do this task but Sublime Text will make it much organized and clean. (It can make you look like a pro too) Click [here](http://www.sublimetext.com/) to see if you would like to try.  

## Get the Source Code

This website is open sourced so it is easy for you to get the source code. Just open the terminal (only mac will support this method) and type :

```
cd /Applications/XAMPP/xamppfiles/htdocs/
```

> this only works if you are using XAMPP. If not, the path will be different. 

then type :

```
git clone  https://github.com/narrator0/ntubagb-website.git
``` 

If you are using windows, click Download ZIP in the bottom left of [this page](https://github.com/narrator0/ntubagb-website). After unachiving put it in the `htdocs` file under the directory of `/XAMPP`. (You have to find it yourself since I'm not a windows user)

> Now you are able to see the website on **local side**. (only you can see it since the browser is just opening the file from your computer, not on the internet) Just open your browser and         type `localhost/ntubagb`.

### Upload it Online

Open FileZilla and put `/Applications/XAMPP/xamppfiles/htdocs/ntubagb` in the `public_html` file and the site will be seen at `http://homepage.ntu.edu.tw/~yourStudentId/ntubagb`. It it the same thing to updata the website, but only need to update the file you change in the future.

> Don't really type `http://homepage.ntu.edu.tw/~yourStudentId/ntubagb` please! Plug your student ID for example `http://homepage.ntu.edu.tw/~b03302015/ntubagb`. Do not Upload all the file in the ntubagb. Only upload the file you changed.

## Mainpage Editing

There chapter will teach you how to make a list in web appliction. As you can see, there are lists of imformation in the homepage.

### Introduce to HTML

A web appliction is actually plain text of a lot of tags like `<html></html>`. These tags tell your browser how to display your web.

Open `ntubagb/page/home.html`. This is what your homepage really looks like. The `<h3></h3>` tag stands for _header3_, so it will look bigger if you use it. The `<ul></u>l` tad stands for _Unordered List_, and `<li></li>` stands for _List Item_ so if you type :

```

<h3>歡迎來到台大工管女籃首頁</h3>
<ul>
	<li>本系統目前然在建置中尚未開放</li>
	<li>初始化程式等待建置中</li>
	<li>網頁後台建置中</li>
</ul>

```
It means the list hearder is `歡迎來到台大工管女籃首頁`, and it has three _List Items_ in it. So it will look like this :

### 歡迎來到台大工管女籃首頁

* 本系統目前然在建置中尚未開放
* 初始化程式等待建置中
* 網頁後台建置中


## Data Management

### Introduce to JSON

JSON is a way to read and store data in web appications. This website also use it the store data. Here you have to know that JSON files are just **plain text** with format syntax. So all you have to do is to add the data to each file and the computer will do do all the other job.

> All the JSON files is under `/ntubagb/manage/data`.

### Video Data Management

Let's use `video.json` (/ntubagb/manage/data/video.json) for example, open it with your _Sublime Text_ and you may see something like this :

```
[
    {
        "title": "台大盃vs機械",
        "link": "https://www.youtube.com/watch?v=YE--RYZB2Fw"
    }, 
    {
        "title": "台大盃vs森林",
        "link": "https://www.youtube.com/watch?v=PiFkWjdsFCY"
    }
]
```

All the JSON file you see in the website will be alike to this. `[]` conatains all the text in the file. In this case, two rows of data divided by a comma is inside. Every row has two columns title and link.

> Be careful that the column name here is **"title"** not **title**.

So if you wanna put some music on the website. Just add like this :

``` 
[
    {
        "title": "台大盃vs機械",
        "link": "https://www.youtube.com/watch?v=YE--RYZB2Fw"
    }, 
    {
        "title": "台大盃vs森林",
        "link": "https://www.youtube.com/watch?v=PiFkWjdsFCY"
    },
    {
        "title": "\"Path of The Wind\" by Joe Hisaishi",
        "link": "https://www.youtube.com/watch?v=MZgBjQFMPvk"
    }
]
```
Try is yourself and you will know how it works.

> Notice that to display `"` you have to write `\"` this is to avoid mistakening the mormal `"` . So in JSON files, if you wanna display charaters like ", [, ], {, } etc. There is a need to add a `\` before it to prevent further mistake.

> Another thing is that the link there _**must**_ be a youtube link, it won't work for any other link and can get an error if you put one. 

### Picture Data Management

Picture data also uses JSON data to store imformation. But in this case, the data only contains imformation of the name and how many pictures in it. But you still have to put the picture in the `/ntubagb/manage/data/pictures` file and there are a few things that must be awared :

* the file name must be the same in the JSON file
* the picture type must be `.jpg` and is defferent from  `.JPG`
* the picture filenames must be numbered started from 1.jpg

> The picture representing the whole album will be `1.jpg`. So if you wanna change it, just change the file which is named after `1.jpg` .

## Statistic Data Management

Statistic data in this website is also stored in JSON files. Here will go through all the file you need to edit. They are listed below :

* cup.json
* game.json
* player.json

These files store basic imformation of the games and memebers. Open it and take a look and you will know how it works.

###  x-x.json

This is where the data will be in. The first x represents which cup the game belongs, and the second x is the which game it belongs. 

> All of them are represented by their id and games with defferent id **must be distinct**. So do not think that the first game in the second cup will be id = "1". Its id will be after the last game of the first cup.

### playerx.json

This is for the players in the game. As you will guess, the x represents the id of the player. Remember to add data to each player after every game. The computer won't collect them for you. 

## Make it Better

Anything in a web application **can** be changed if you are willing to learn. Learn basic html as a start if you are planning to make it better.

If you need any help, contact me at **tmimvhaung@gmail.com**.