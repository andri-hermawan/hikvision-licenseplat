// awal socket io
var app = require('http').createServer(handler),
    io = require('socket.io').listen(app),
    fs = require('fs');

app.listen(3001, function() {
  console.log('Socket IO Server is listening on port 3001');
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
  host: "172.16.10.14",  
  user: "admin_db",  
  password: "!G@j4hMada!",  
  database: "cctv_db"  
});

net.createServer(function (socket) {
  var ip_client = socket.remoteAddress.substr(7);
  console.log('TCP SERVER CONNECT',ip_client);
 
  // GET_ISAPI_CAPTURE();
  const url = 'http://172.16.10.30/ISAPI/Traffic/MNPR/channels/1';
  const options = {
    method: 'GET',
    rejectUnauthorized: false,
    digestAuth: "admin:hik12345",
  //   content: "Hello world. Data can be json or xml.",
    headers: {
      'Content-Type': 'application/xml'  
    }
  };
  const responseHandler = (err, data, res) => {
    if (err) {
      console.log(err);
    }


    var datas = data.toString('utf8'); 
    var awal = datas.indexOf("<EventNotificationAlert");
    var akhir = datas.indexOf("</EventNotificationAlert>") + 25;
    var ambil = akhir - awal ;
    var hasil = datas.substr(awal,ambil);

    xml2js.parseString(hasil, (err, result) => {
      if(err) {
          throw err;
      }
      var ip_cam = result.EventNotificationAlert.ipAddress[0];
      var license_plat = result.EventNotificationAlert.ANPR[0].licensePlate[0];

      io.sockets.emit( 'emit_from_server', {
        VIPCAM: ip_cam,
        VLICENSEPLAT: license_plat
      });
      con.query('INSERT INTO mtcapture (VIPCAM, VLICENSEPLAT) VALUES ("'+ip_cam+'","'+license_plat+'" ) ');
      // console.log(result.EventNotificationAlert.ANPR[0].licensePlate[0]);
      // console.log(result.EventNotificationAlert.ipAddress[0]);
      // console.log(res.statusMessage);
      
    });

    // var datas = data.toString('utf8'); 
    // var ip_cam = datas.substr(227,12);
    // var license_plat = datas.substr(667,8);
    // // var dcreate = datas.substr(405,29);
    // io.sockets.emit( 'emit_from_server', {
    //   VIPCAM: ip_cam,
    //   VLICENSEPLAT: license_plat
    // });
    
    
    // con.query('INSERT INTO mtcapture (VIPCAM, VLICENSEPLAT) VALUES ("'+ip_cam+'","'+license_plat+'" ) ');
    // var sql = "INSERT INTO mtcapture (ID, VIPCAM, VLICENSEPLAT, DCREATED) VALUES (' ', ip_cam, license_plat, '1')";  
    // con.query('INSERT INTO mtcapture (ID, VIPCAM, VLICENSEPLAT, DCREATED) VALUES (' ', ip_cam, license_plat, '1')', function (err, result) {  
    //   console.log("1 record inserted");  
    // });  
  }
  httpClient.request(url, options, responseHandler);

  socket.on('data', function(data) {
    // console.log('socket', socket.needReadable);
    // console.log('socket connected net',data);
    // io.sockets.emit('CH01', 'me', 'test msg');
    // var line = data.toString();
    // console.log('got "data"', line);
    // socket.pipe(writable);
    // io.sockets.emit('emit_from_server', line); // socket.io呼び出し
  });
  // socket.on('end', function() {
  //   console.log('end');
  // });
  // socket.on('close', function() {
  //   console.log('close');
  // });
  // socket.on('error', function(e) {
  //   console.log('error ', e);
  // });
  // socket.write('hello from tcp server');
}).listen(3000, function() {
  console.log('TCP Server is listening on port 3000');
});

// awal TCP server




