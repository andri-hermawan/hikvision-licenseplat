
const httpClient = require('urllib');

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
   
    // var datas = data.toString('utf8'); 
    // var ip_cam = datas.substr(227,12);
    // var license_plat = datas.substr(665,8);
    console.log(datas)
  }
  httpClient.request(url, options, responseHandler);




