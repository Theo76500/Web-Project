const Joi = require('joi');
const mysql = require('mysql');
const express = require('express');
const app = express();
const bodyParser = require('body-parser');

app.use(express.json());
app.use(bodyParser.urlencoded({
  extended: true
}));

//connection to the database

let mysqlConnection = mysql.createConnection({
  host:'localhost',
  user:'root',
  password: '',
  database: 'bdecesi',
  charset: 'utf8'
});

/*       *
 *       *
 *       *
 * FOR ADMIN *
 *       *
 *       */

//get the role (student staff administrator)

app.get('/api/admin/verif/:role/:route', (req, res) => {
  let role = req.params.role;
  let route = req.params.route;
  res.redirect(`http://projetapi/admin/verif/${role}/${route}`);
});

//Access to all participants of an event

app.get('/api/admin/participantsList/:id', (req, res) => {
    let id = req.params.id;
    mysqlConnection.query(`SELECT DISTINCT USE_username FROM t_users INNER JOIN register ON (t_users.USE_id = register.USE_id) INNER JOIN t_activities ON (t_activities.ACT_id = register.ACT_id) WHERE t_activities.ACT_id = '${id}'`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//Remove an activity according to an id

app.get('/api/admin/removeEvent/:id', (req, res) => {
    let id = req.params.id
    mysqlConnection.query(`DELETE t_activities,t_pictures FROM t_activities INNER JOIN t_pictures ON t_pictures.ACT_id = t_activities.ACT_id WHERE t_activities.ACT_id = ${id}`, (err, rows, fields) => {
        if(!err){
            res.redirect('http://bdecesi.fr/admin/see');
        } else {
            console.log(err);
        }
    });
});

// recorvers all activity

app.get('/api/event', (req, res) => {
    mysqlConnection.query(`SELECT * FROM t_activities`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//count all activity

app.get('/api/countEvent', (req, res) => {
    mysqlConnection.query(`SELECT ACT_id FROM t_activities`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//ADD PRODUCTS

app.post('/api/admin/addProduct', (req, res) => {
  let name = req.body.name;
  let description = req.body.description;
  let price = req.body.price;
  mysqlConnection.query(`INSERT INTO t_products (PRO_name, PRO_description, PRO_price, PRO_quantity) VALUES('${name}', '${description}', '${price}', 1)`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/admin/insert');
    } else {
      console.log(err);
    }
  });
});

//recovers the max id for display correctly the products

app.get('/api/admin/maxProId', (req, res) => {
    mysqlConnection.query(`SELECT MAX(PRO_id) FROM t_products`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//add pictures for products

app.post('/api/admin/addPicturesProduct', (req, res) => {
  let namePic = req.body.name;
  let PRO_id = req.body.description;
  mysqlConnection.query(`INSERT INTO t_pictures (PIC_name, PRO_id) VALUES('${namePic}', '${PRO_id}')`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/admin/insert');
    } else {
      console.log(err);
    }
  });
});

//REMOVE PRODUCTS

//count all the products to display them in the datatables

app.get('/api/admin/countProduct', (req, res) => {
    mysqlConnection.query(`SELECT PRO_id FROM t_products`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//recorvers all products

app.get('/api/admin/product', (req, res) => {
    mysqlConnection.query(`SELECT * FROM t_products`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//remove a products

app.get('/api/admin/removeProduct/:id', (req, res) => {
    let id = req.params.id
    mysqlConnection.query(`DELETE FROM t_products WHERE PRO_id = ${id}`, (err, rows, fields) => {
        if(!err){
            res.redirect('http://bdecesi.fr/admin');
        } else {
            console.log(err);
        }
    });
});

/*          *
 *          *
 *          *
 * FOR CESI STAFF *
 *          *
 *          */

app.get('/api/staff/notif', (req, res) => {
    mysqlConnection.query(`SELECT USE_username, USE_email FROM t_users WHERE ROL_id = 3`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//count all the user administrator to display them in the datatables

app.get('/api/admin/countAdmin', (req, res) => {
    mysqlConnection.query(`SELECT USE_id FROM t_users WHERE USE_id = 3`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

/*         *
 *         *
 *         *
 * FOR EVERYBODY *
 *         *
 *         */

// search

app.get('/api/result/:search/:zone/:limit/:date/:prix/:category', (req, res) => {
  let search = req.params.search;
  let zone = req.params.zone;
  let limit = req.params.limit;
  let date = req.params.date;
  let prix = req.params.prix;
  let category = req.params.category;
  let order_date, order_prix;

  if (date == "recent") {
    order_date = "ASC";
  } else if (date == "ancien") {
    order_date = "DESC";
  }

  if (prix == "croissant") {
    order_prix = "ASC";
  } else if (prix == "decroissant") {
    order_prix = "DESC";
  }
//research by activity
  if (zone == "activite" ) {
    mysqlConnection.query(`SELECT *, DATE_FORMAT(ACT_date, "%d/%m/%Y à %Hh%i") AS ACT_date_h FROM t_activities INNER JOIN t_pictures ON (t_pictures.ACT_id = t_activities.ACT_id) WHERE t_activities.ACT_name LIKE "%${search}%" ORDER BY ACT_price ${order_prix}, ACT_date ${order_date} LIMIT ${limit}`, (err, rows, fields) => {
      if(!err){
        res.send(rows);
      } else {
        console.log(err);
      }
    });
  }
  //research by shop ("boutique") for all categories
  else if (zone == "boutique" && category == "all") {
    mysqlConnection.query(`SELECT * FROM t_products INNER JOIN t_pictures ON (t_pictures.PRO_id = t_products.PRO_id) WHERE t_products.PRO_name LIKE "%${search}%" ORDER BY PRO_price ${order_prix}, PRO_updated_at ${order_date} LIMIT ${limit} `, (err, rows, fields) => {
      if(!err){
        res.send(rows);
      } else {
        console.log(err);
      }
    });
  }
  //research by shop ("boutique") for a specific category
  else if (zone == "boutique" && category != "all") {
    mysqlConnection.query(`SELECT * FROM t_products INNER JOIN t_pictures ON (t_pictures.PRO_id = t_products.PRO_id) INNER JOIN categorize ON (t_products.PRO_id = categorize.PRO_id) INNER JOIN t_categories ON (categorize.CAT_id = t_categories.CAT_id) WHERE t_categories.CAT_name = "${category}" AND t_products.PRO_name LIKE "%${search}%" ORDER BY PRO_price ${order_prix}, PRO_updated_at ${order_date} LIMIT ${limit} `, (err, rows, fields) => {
      if(!err){
        res.send(rows);
      } else {
        console.log(err);
      }
    });
  }

});

//add comment(s) to an activity

app.post('/api/activity/:id_act/comment/user/:id_user', (req, res) => {
  let id_act = req.params.id_act;
  let id_user = req.params.id_user;
  let comment = req.body.comment;

  mysqlConnection.query(`INSERT INTO t_comments (COM_content, COM_created_at, USE_id, ACT_id) VALUES ('${comment}', NOW(), '${id_user}', '${id_act}')`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/activity/' + id_act);
    } else {
      console.log(err);
    }
  });
});

//add a like to an activity

app.post('/api/activity/:id/likes', (req, res) => {
  let id = req.params.id;
  mysqlConnection.query(`UPDATE t_activities SET ACT_likes = ACT_likes + 1 WHERE ACT_id = ${id}`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/activity/' + id);
    } else {
      console.log(err);
    }
  })
});

//display comment

app.get('/api/activity/:id/comments', (req, res) => {
  let id = req.params.id;
  mysqlConnection.query(`SELECT * FROM t_comments INNER JOIN t_users ON (t_users.USE_id = t_comments.USE_id) WHERE ACT_id = ${id}`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

//

app.get('/api/:idUser/register', (req, res) => {
  let id = req.params.idUser;
  mysqlConnection.query(`SELECT * FROM register WHERE USE_id = ${id}`,  (err, rows, fields) =>{
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  })
})

//disconnection 

app.get('/api/session/:id/logout', (req, res) => {
  let id = req.params.id;
  res.redirect('http://bdecesi.fr/')
});

app.post('/api/activity/:idAct/register/user/:idUser', (req, res) => {
  let idAct = req.params.idAct;
  let idUser = req.params.idUser;

  mysqlConnection.query(`INSERT INTO register VALUES('${idAct}', '${idUser}')`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/activity/' + idAct)
      return;
    } else {
      console.log(err);
    }
  })
});

//remove an user

app.post('/api/activity/:idAct/cancel/user/:idUser', (req, res) => {
  let idAct = req.params.idAct;
  let idUser = req.params.idUser;

  mysqlConnection.query(`DELETE FROM register WHERE ACT_id = '${idAct}' AND USE_id = '${idUser}'`, (err, rows, fields) => {
    if(!err){
      res.redirect('http://bdecesi.fr/activity/' + idAct)
      return;
    } else {
      console.log(err);
    }
  })
});

//delete a comment

app.post('/api/activity/:id_act/delete/:id_comment', (req, res) => {
    let id_comment = req.params.id_comment;
    let id_act = req.params.id_act;
    mysqlConnection.query(`DELETE FROM t_comments WHERE COM_id = '${id_comment}'`, (err, rows, fields) => {
        if(!err){
            res.redirect('http://bdecesi.fr/activity/' + id_act);
        } else {
            console.log(err);
        }
    });
});

//found the best product

app.get('/api/products_best', (req, res) => {
    mysqlConnection.query("SELECT * FROM t_pictures INNER JOIN t_products ON (t_pictures.PRO_ID = t_products.PRO_id) INNER JOIN compose ON (compose.PRO_id = t_products.PRO_id) GROUP BY compose.PRO_id ORDER BY compose.quantity LIMIT 3", (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//display all product

app.get('/api/panier/:name', (req, res) => {
  let name = req.params.name;
  mysqlConnection.query(`SELECT * FROM t_products INNER JOIN t_pictures ON (t_pictures.PRO_id = t_products.PRO_id) WHERE t_products.PRO_name = "${name}"`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

//search the data from user connected

app.get('/api/session/:user' , (req, res) => {
  let user = req.params.user + '/';
  mysqlConnection.query(`SELECT USE_id, ROL_id FROM t_users WHERE t_users.USE_username = "${user}" OR t_users.USE_email = "${user}"`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

app.post('/api/users/register', (req, res) => {
  let username = req.body.username;
  let password = req.body.password;
  let email = req.body.email;
  let campus = req.body.campus;

  mysqlConnection.query('SELECT * FROM t_users', (err, rows, fields) => {
    if(!err){
      for(let i = 0; i < rows.length; i++){
        if(username == rows[i].USE_username){
          res.redirect('http://bdecesi.fr/registration?success=false&twins=username');
          return;
        } else if(email == rows[i].USE_email){
          res.redirect('http://bdecesi.fr/registration?success=false&twins=email');
          return;
        } else if(password == rows[i].USE_password){
          res.redirect('http://bdecesi.fr/registration?success=false&twins=password');
          return;
        }
      }

      mysqlConnection.query(`INSERT INTO t_users (USE_username, USE_password, USE_email, USE_created_at, USE_updated_at, PIC_id, CAM_id, ROL_id) VALUES ('${username}', '${password}', '${email}', NOW(), NOW(), 1, '${campus}', 1)`, (err, rows, fields) => {
        if(!err){
          res.redirect('http://bdecesi.fr/registration?success=true');
        } else {
          console.log(err);
        }
      });
    } else {
      console.log(err);
    }
  });
});

app.get('/api/:id/profile', (req, res) => {
  let id = req.params.id;

  mysqlConnection.query(`SELECT * FROM t_users LEFT JOIN t_campus ON (t_users.CAM_id = t_campus.CAM_id) LEFT JOIN t_specialities ON (t_users.SPE_id = t_specialities.SPE_id) INNER JOIN t_roles ON (t_users.ROL_id = t_roles.ROL_id) INNER JOIN t_pictures ON (t_users.PIC_id = t_pictures.PIC_id) WHERE t_users.USE_id = ${id}`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

app.post('/api/users/login', (req, res) => {
  mysqlConnection.query('SELECT * FROM t_users', (err, rows, fields) => {
    if(!err){
      let user = req.body.user;
      let password = req.body.password;
      let valid = false;

      for(let i = 0; i < rows.length; i++){
        if(((user == rows[i].USE_username) || (user == rows[i].USE_email)) && (password == rows[i].USE_password)){
          res.redirect('http://bdecesi.fr/login?success=true');
          return;
        }
      }
        res.redirect('http://bdecesi.fr/login?success=false')
        return;
    } else {
      console.log(err);
    }
  });
});

app.get('/api/activities', (req, res) => {
    mysqlConnection.query('SELECT *, DATE_FORMAT(ACT_date, "%d/%m/%Y à %Hh%i") AS ACT_date_h FROM t_activities INNER JOIN t_pictures ON (t_pictures.ACT_id = t_activities.ACT_id) WHERE PIC_main = 1', (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});

//Insert a picture for the activity

app.post('/api/activity/:id/picture', (req, res) => {
  let name = req.body.file_name;
  let id = req.params.id;
    mysqlConnection.query(`INSERT INTO t_pictures (PIC_name, PIC_created_at, PIC_updated_at, USE_id, ACT_id, PRO_id, PIC_main) VALUES ('${name}', NOW(), NOW(), NULL, '${id}', NULL, 0)`, (err, rows, fields) => {
        if(!err){
            res.redirect('http://bdecesi.fr/activity/' + id);
        } else {
            console.log(err);
        }
    });
});

//for recovers the avatar of a user

app.get('/api/pictures', (req, res) => {
    mysqlConnection.query(`SELECT PIC_name FROM t_pictures`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
})

//recovers products with pictures

app.get('/api/products', (req, res) => {
  mysqlConnection.query(`SELECT * FROM t_products INNER JOIN t_pictures ON (t_pictures.PRO_id = t_products.PRO_id)`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

//recovers activity

app.get('/api/activity/:id', (req, res) => {
  let id = req.params.id;
  mysqlConnection.query(`SELECT *, DATE_FORMAT(ACT_date, "%d/%m/%Y %Hh%i") AS ACT_date_h, DATE_FORMAT(ACT_created_at, "%d/%m/%Y %Hh%i") AS ACT_created_h FROM t_activities INNER JOIN t_pictures ON (t_pictures.ACT_id = t_activities.ACT_id) WHERE t_activities.ACT_id = ${id}`, (err, rows, fields) => {
    if(!err){
      res.send(rows);
    } else {
      console.log(err);
    }
  });
});

app.get('/api/activity/:id/pictures', (req, res) => {
    let id = req.params.id
    mysqlConnection.query(`SELECT * FROM t_activities INNER JOIN t_pictures ON (t_activities.ACT_id = t_pictures.ACT_id) WHERE t_activities.ACT_id = ${id} AND PIC_main = 0`, (err, rows, fields) => {
        if(!err){
            res.send(rows);
        } else {
            console.log(err);
        }
    });
});


const port = process.env.PORT || 3000
app.listen(port, () => {
  console.log(`Listening on port ${port}...`);
});