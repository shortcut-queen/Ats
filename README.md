 Ats(军校训练管理系统)
==============================================================
军校训练管理系统是一个适用于军校日常训练数据管理的WEB项目

项目介绍
-------------------------------------------------------------
本军校训练管理系统基于Apache,数据库是MySQL.
### 项目结构
├── index.php         项目入口文件
├── Admin        


系统功能
-------------------------------------------------------------
该系统实现了学生用户和管理员用户的登录功能，学生训练成绩的查询，录入，更改，分析等功能

项目使用条件
-------------------------------------------------------------
Apache>=2.4
MySQL>=4.1

安装
-------------------------------------------------------------
  1.建议使用集成开发环境XAMPP，此款软件便于运行php文件，数据库名为ats，需要在MySQL中建12个表，具体的SQL语句在文件ats.sql中，其中需要填写账号name和密码pwd，否则无法登陆;</br>
  2.用集成开发环境XAMPP，能够直接一步到位，因为它将Apache、MySQL等集成在了一起；注意有时因为80端口号有可能被占用了，影响软件的正常运行，可以改成8080端口等其他端口;</br>
  3.把该系统的代码文件夹放在XAMPP的localhost文件夹下，在XAMPP的control面板中运行Apache和MySQL;</br>
  4.在浏览器中输入localhost:8080(你的端口号)/Ats即可进入系统</br>

项目运行效果
--------------------------------------------------------------
### 用户登录界面
![Image text](https://github.com/shortcut-queen/Ats/blob/master/Project_Img/user_home_page.png)

### 管理员登录界面
![Image text](https://github.com/shortcut-queen/Ats/blob/master/Project_Img/admin_home_page.png)

### 龙虎榜(优秀训练成绩展示界面)
![Image text](https://github.com/shortcut-queen/Ats/blob/master/dargon-tiger.png)

### 用户登录后界面展示
![Image text](https://github.com/shortcut-queen/Ats/blob/master/resource-pool.png)

### 管理员登录后界面展示
![Image text](https://github.com/shortcut-queen/Ats/blob/master/admin-manage.png)
商业友好的开源协议
--------------------------------------------------------------
Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，同样允许代码修改，再作为开源或商业软件发布。











Ats(Army school training system)
=============================================================
Army school training system is a web project suit for army school daily training management.

System discription
--------------------------------------------------------------
I develope this system for students of army school students.

system function
----------------------------------------------------------------
The administrator can manage the students,training projects,training resources (include pictures,text docments and videos) and students' training scores.

Prerequisites
----------------------------------------------------------------
Apache>=2.4
MySQL>=4.1

Installing
----------------------------------------------------------------
1.It is recommended to use the integrated development environment XAMPP. This software is convenient for running php files. The database name is ats. You need to build 12 tables in MySQL. The specific SQL statement is in the file ats.sql. You need to fill in the account name and password pwd. Otherwise, Can not log in;</br>
2.With the integrated development environment XAMPP, it can be directly in place, because it integrates Apache, MySQL, etc.; note that sometimes because the 80 port number may be occupied, affecting the normal operation of the software, you can change to other ports such as 8080 port.</br>
3.Put the system's code folder in XAMPP's localhost folder and run Apache and MySQL in the XAMPP control panel.</br>
4.Enter localhost:8080 (your port number)/Ats in the browser to enter the system

Running the tests
----------------------------------------------------------------
### User-login interface
![Image text](https://github.com/shortcut-queen/Ats/blob/master/Project_Img/user_home_page.png)

### Admin-login interface
![Image text](https://github.com/shortcut-queen/Ats/blob/master/Project_Img/admin_home_page.png)

### Excellent performance display interface
![Image text](https://github.com/shortcut-queen/Ats/blob/master/dargon-tiger.png)

### User-logined interface
![Image text](https://github.com/shortcut-queen/Ats/blob/master/resource-pool.png)

### Admin-logined interface
![Image text](https://github.com/shortcut-queen/Ats/blob/master/admin-manage.png)

License
-----------------------------------------------------------------
Licence is the protocol adopted by the famous non-profit open source organization Apache. The agreement is similar to BSD, encouraging code sharing and respecting the original author's copyright, as well as allowing code modifications to be released as open source or commercial software.
