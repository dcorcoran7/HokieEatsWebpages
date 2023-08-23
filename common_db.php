<?php
  define('DB_HOST', "pamplin-bit2020.mysql.database.azure.com"); 
  define('DB_USER', "bit4444s21-group10");
  define('DB_PASS', "EZScP3Pmq6rMFcFT");
  define('DB_PORT', "3306");
  define('CERT', "-----BEGIN CERTIFICATE-----
  MIIDrzCCApegAwIBAgIQCDvgVpBCRrGhdWrJWZHHSjANBgkqhkiG9w0BAQUFADBh
  MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3
  d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD
  QTAeFw0wNjExMTAwMDAwMDBaFw0zMTExMTAwMDAwMDBaMGExCzAJBgNVBAYTAlVT
  MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j
  b20xIDAeBgNVBAMTF0RpZ2lDZXJ0IEdsb2JhbCBSb290IENBMIIBIjANBgkqhkiG
  9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4jvhEXLeqKTTo1eqUKKPC3eQyaKl7hLOllsB
  CSDMAZOnTjC3U/dDxGkAV53ijSLdhwZAAIEJzs4bg7/fzTtxRuLWZscFs3YnFo97
  nh6Vfe63SKMI2tavegw5BmV/Sl0fvBf4q77uKNd0f3p4mVmFaG5cIzJLv07A6Fpt
  43C/dxC//AH2hdmoRBBYMql1GNXRor5H4idq9Joz+EkIYIvUX7Q6hL+hqkpMfT7P
  T19sdl6gSzeRntwi5m3OFBqOasv+zbMUZBfHWymeMr/y7vrTC0LUq7dBMtoM1O/4
  gdW7jVg/tRvoSSiicNoxBN33shbyTApOB6jtSj1etX+jkMOvJwIDAQABo2MwYTAO
  BgNVHQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUA95QNVbR
  TLtm8KPiGxvDl7I90VUwHwYDVR0jBBgwFoAUA95QNVbRTLtm8KPiGxvDl7I90VUw
  DQYJKoZIhvcNAQEFBQADggEBAMucN6pIExIK+t1EnE9SsPTfrgT1eXkIoyQY/Esr
  hMAtudXH/vTBH1jLuG2cenTnmCmrEbXjcKChzUyImZOMkXDiqw8cvpOp/2PV5Adg
  06O/nVsJ8dWO41P0jmP6P6fbtGbfYmbW0W5BjfIttep3Sp+dWOIrWcBAI+0tKIJF
  PnlUkiaY4IBIqDfv8NZ5YBberOgOzW6sRBc4L0na4UU+Krk2U886UAb3LujEV0ls
  YSEY1QSteDwsOoBrp+uvFRTp2InBuThs4pFsiv9kuXclVzDAGySj4dzp30d8tbQk
  CAUw7C29C79Fv1C5qfPrmAESrciIxpg0X40KPMbp1ZWVbd4=
  -----END CERTIFICATE-----");


  class MySQLDB {
    private $dbConn;

    public function openConnection() {
      $this->dbConn = mysqli_init();
      mysqli_ssl_set($this->dbConn,NULL,CERT, NULL, NULL, NULL);

      mysqli_real_connect($this->dbConn, DB_HOST, DB_USER, DB_PASS, DB_USER, DB_PORT, MYSQLI_CLIENT_SSL);

      if(mysqli_connect_errno()) {
        die( "Database connection error: ".mysqli_connect_error()."(".mysqli_connect_errno().")" );
      }
    }

    public function close_connection() {
      if(isset($this->dbConn)) {
        mysqli_close($this->dbConn);
        unset($this->dbConn);
      }
    }

    public function query($sql) {
      $result = mysqli_query($this->dbConn, $sql);
      if(!$result) {
        die("Database query error: ".mysqli_error($this->dbConn)." (".mysqli_errno($this->dbConn).")");
      }
      return $result;
    }

    public function jsonQuery($sql) {
      $result = mysqli_query($this->dbConn, $sql);
      if(!$result) {
        die("Database query error: ".mysqli_error($this->dbConn)." (".mysqli_errno($this->dbConn).")");
      }

      $data = array();
      for($x=0; $x<mysqli_num_rows($result);$x++){
        $data[] = mysqli_fetch_assoc($result);
      }
      
      return json_encode($data);
    }

    function __construct(){
      $this->openConnection();
    }
  }

  $mydb = new MySQLDB();
 ?>
