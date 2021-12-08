// socket io
var app = require('http').createServer(handler),
    io = require('socket.io').listen(app),
    fs = require('fs');

    const port_tcp = 3000;
    const port_socket = 3001;
    const host = '192.168.10.22';

app.listen(port_socket,host, function() {
  console.log(`Socket IO Server is listening on port ${port_socket} at ${host}`); 
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
  console.log('Socket Connected...',socket.id);

  socket.on('disconnect', () => {
    console.log('user disconnected');
  });


});

// TCP server
var net = require('net');
var writable = require('fs').createWriteStream('test.txt');
var mysql = require('mysql'); 
const httpClient = require('urllib');
const xml2js = require('xml2js');

var con = mysql.createConnection({  
  host: "localhost",  
  user: "andri",  
  password: "!G@j4hMada!",  
  database: "Bara12345#"  
});


net.createServer(function (socket) {
  console.log(`${socket.remoteAddress} TCP Connected`);

  const url = 'http://'+socket.remoteAddress+'/ISAPI/Traffic/MNPR/channels/1';
  const options = {
    method: 'GET',
    rejectUnauthorized: false,
    digestAuth: "admin:Admin123",
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
      
    });
  }
  httpClient.request(url, options, responseHandler);




  socket.on('data', function(data) {
    var line = data.toString();
    console.log('got "data"', line);
    // socket.pipe(writable);
    // io.sockets.emit('emit_from_server', line); // socket.io呼び出し

    //Log data from the client
    // console.log(`${socket.remoteAddress}:${socket.remotePort} Says : ${data} `);
  });
  socket.on('end', function() {
    console.log('end');
  });
  socket.on('close', function() {
    console.log('close');
  });
  socket.on('error', function(e) {
    console.log('error ', e);
  });
  socket.write('hello from tcp server');
}).listen(port_tcp,host, function() {
    console.log(`TCP Server is listening on port ${port_tcp} at ${host}`); 
});