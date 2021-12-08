// awal socket io
var app = require('http').createServer(handler),
    io = require('socket.io').listen(app),
    fs = require('fs');

var ipserver = '188.88.3.39';
app.listen(3001,ipserver, function() {
  console.log('Socket IO Server is listening on port 3001' );
});

function handler(req, res) {
  fs.readFile(__dirname + '/index.html', function(err, data) {
    if(err) {
      res.writeHead(500);
      return res.end('Error');
    }
    res.writeHead(200);
    res.write(data);
    res.end();
  })
};

// 待ち受け
io.sockets.on('connection', function(socket) {
  console.log('connection socket io...', socket.id);

  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', { 
    	new_count_message: data.new_count_message

    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message 
    });
  });

  socket.on( 'new_message', function( data ) {
    io.sockets.emit( 'new_message', {
    	name: data.name,
    	email: data.email,
    	subject: data.subject,
    	created_at: data.created_at,
    	id: data.id
    });
  });

});
// akhir socket io
//----------------------------------------------------------------------------------

// awal TCP server
var net = require('net');
var writable = require('fs').createWriteStream('test.txt');
var mysql = require('mysql'); 
const httpClient = require('urllib');
const xml2js = require('xml2js');

var con = mysql.createConnection({  
  host: "localhost",  
  user: "root",  
  password: "",  
  database: "cctv_db"  
});
net.createServer(function (sock) {

    console.log('CONNECTED:',sock.remoteAddress.substr(7));
    setInterval(get_data_cctv, 30000);


    sock.on('data', function(data) {
      // console.log(data);
        // console.log('DATA',sock.remoteAddress,': ',data,typeof data,"===",typeof "exit");
        // if(data === "exit") console.log('exit message received !');
    });

    //ambil data 
    function get_data_cctv (){
      // var random_no4 =(Math.floor(Math.random() * 10000) + 10000).toString().substring(1);
      var random_no4 =100;
      var random_no6 ='B'+ Math.floor(100000 + Math.random() * 900000);

      var random_ip = Math.floor(Math.random() * 5) + 1; 
      
      switch (random_ip) {
        case 1:
          var random_lokasi = '172.16.10.30';
          break;
        case 2:
          var random_lokasi = '192.168.10.21';
          break;
        case 3:
          var random_lokasi = '172.16.10.32';
          break;
        case 4:
          var random_lokasi = '172.16.10.33';
          break;
        case 5:
          var random_lokasi = '172.16.10.34';
          break;
        default:
          var random_lokasi = '172.0.0.1';
          break;
      }
      // console.log(random_lokasi);
      // console.log('ambil data cctv');
     

      con.query('INSERT INTO mtcapture SET ?', {VIPCAM: random_lokasi, VLICENSEPLAT: random_no6}, function(err, result, fields) {
        if (err) throw err;
        con.query('INSERT INTO mtweight (IDCAPTURE, FVALUE) VALUES ('+result.insertId+','+random_no4+')');
        
        io.sockets.emit( 'emit_from_server', {
          VIPCAM: random_lokasi,
          VLICENSEPLAT: random_no6
        });

        //get_data_weight(result.insertId,random_lokasi);
      });

      con.query("SELECT b.VLOCATION_NAME,count(*) as FCOUNT FROM cctv_db.mtcapture a LEFT JOIN cctv_db.mtsetting b on a.VIPCAM = b.VIPCAM LEFT JOIN cctv_db.mtweight c on a.ID = c.IDCAPTURE WHERE a.DCREATED BETWEEN date_format(CURDATE(), '%Y-%m-%d 09:00:00') AND date_format(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '%Y-%m-%d 	06:00:00') GROUP BY b.VLOCATION_NAME", function (err, result, fields) {
        if (err) throw err;
        // console.log(result);
        io.sockets.emit( 'emit_push_weight', {
          new_result: result
        });
      });
      

      con.query(" SELECT sum(fvalue) AS ftotal_ritase FROM vw_target_chart_ritase", function (err, result, fields) {
        if (err) throw err;
        // console.log(result);
        io.sockets.emit( 'emit_total_all_ritase_today', {
          new_result: result
        });
      });
      con.query("SELECT count(DISTINCT VLICENSEPLAT) as fhauler FROM mtcapture WHERE VIPCAM = '192.168.10.21' AND DCREATED BETWEEN date_format(CURDATE(), '%Y-%m-%d 09:00:00') AND date_format(DATE_ADD(CURDATE(), INTERVAL 1 DAY), 		'%Y-%m-%d 	06:00:00') ORDER BY DCREATED DESC", function (err, result, fields) {
        if (err) throw err;
        // console.log(result);
        io.sockets.emit( 'emit_total_all_hauler_ritase_today', {
          new_result: result
        });
      });
      


      con.query(" SELECT sum(fvalue) AS ftotal_tonase FROM vw_target_chart_tonase", function (err, result, fields) {
        if (err) throw err;
        // console.log(result);
        io.sockets.emit( 'emit_total_all_tonase_today', {
          new_result: result
        });
      });



    }

    function get_data_weight (v,l){
      console.log("ambil data timbangan", v,l)

      fs.readFile('Z:/test_ntfs/mamen.txt', 'utf8' , (err, data) => {
        if (err) {
          console.error(err)
          return
        }
        console.log(data)
      })

      // const fs = require('fs');
      // const testFolder = 'Z:/mamen.txt';

      // fs.readdir(testFolder, (err, files) => {
      //   if (err) return console.log(err);
      //   for (let file of files) {
      //     console.log(file);
      //   }
      // });
      
    }









  // var ip_client = socket.remoteAddress.substr(7);
  // console.log('TCP SERVER CONNECT',ip_client);
 
  // GET_ISAPI_CAPTURE();
  // const url = 'http://172.16.10.30/ISAPI/Traffic/MNPR/channels/1';
  // const options = {
  //   method: 'GET',
  //   rejectUnauthorized: false,
  //   digestAuth: "admin:hik12345",
  //   headers: {
  //     'Content-Type': 'application/xml'  
  //   }
  // };
  // const responseHandler = (err, data, res) => {
  //   if (err) {
  //     console.log(err);
  //   }


  //   var datas = data.toString('utf8'); 
  //   var awal = datas.indexOf("<EventNotificationAlert");
  //   var akhir = datas.indexOf("</EventNotificationAlert>") + 25;
  //   var ambil = akhir - awal ;
  //   var hasil = datas.substr(awal,ambil);

  //   xml2js.parseString(hasil, (err, result) => {
  //     if(err) {
  //         throw err;
  //     }
  //     var ip_cam = result.EventNotificationAlert.ipAddress[0];
  //     var license_plat = result.EventNotificationAlert.ANPR[0].licensePlate[0];

  //     io.sockets.emit( 'emit_from_server', {
  //       VIPCAM: ip_cam,
  //       VLICENSEPLAT: license_plat
  //     });
  //     con.query('INSERT INTO mtcapture (VIPCAM, VLICENSEPLAT) VALUES ("'+ip_cam+'","'+license_plat+'" ) ');
  //   }); 
  // }
  
  // httpClient.request(url, options, responseHandler);

  // socket.on('data', function(data) {
  //   console.log('socket connected net');
  // });

  //  socket.on('end', function() {
  //   console.log('end');
  // });
  // socket.on('close', function() {
  //   console.log('close');
  // });
  // socket.on('error', function(e) {
  //   console.log('error ', e);
  // });
  // // socket.write('hello from tcp server');

}).listen(3000, ipserver, function() {
  // console.log('TCP Server is listening on port 3000', ${ipserver});
  console.log(`Server running at http://${ipserver}/`);
});


// awal TCP server




