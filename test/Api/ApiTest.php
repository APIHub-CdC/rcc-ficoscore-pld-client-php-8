<?php 
namespace RCCFSPLD\MX\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack as handlerStack;

use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;

use \RCCFSPLD\MX\Client\Api\RCCFSPLDApi as Instance;
use \RCCFSPLD\MX\Client\Configuration;

use \RCCFSPLD\MX\Client\Model\CatalogoEstados;
use \RCCFSPLD\MX\Client\Model\PersonaPeticion;
use \RCCFSPLD\MX\Client\Model\DomicilioPeticion;
use \PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function setUp(): void {

        $this->x_api_key = "";
        $this->username = "";
        $this->password = "";
        $host = "";
        $password = getenv('KEY_PASSWORD');

        $this->signer = new KeyHandler(null, null, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));
        
        $config = new Configuration();
        $config->setHost($host);
        $client = new Client(['handler' => $handler]);
        $this->apiInstance = new Instance($client, $config);
        
    }

    public function testGetReporte(): void
    {
        $estado = new CatalogoEstados();
        $request = new PersonaPeticion();
        $domicilio = new DomicilioPeticion();        

        $request->setPrimerNombre("JUAN");
        $request->setApellidoPaterno("PRUEBA");
        $request->setApellidoMaterno("SIETE");
        $request->setFechaNacimiento("1980-01-07");
        $request->setRfc("PUAC800107");
        $request->setCurp(null);
        $request->setNacionalidad("MX");
    
        $domicilio->setDireccion("XXXXXXXXX");
        $domicilio->setColoniaPoblacion("XXXXXXXXX");
        $domicilio->setDelegacionMunicipio("XXXXXXXXX");
        $domicilio->setCiudad("XXXXXXXXX");
        $domicilio->setEstado($estado::TLAX);
        $domicilio->setCp("90800");
        $request->setDomicilio($domicilio);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $this->username, $this->password, $request);
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);
        } catch (Exception $e) {
            echo 'Exception when calling RCC-FS-PLDApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    } 

 

}
