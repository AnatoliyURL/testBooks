<?php
namespace app\modules\book\clients;

use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

class SmsPilotClient extends BaseObject
{
    private string $_apiKey = '';
    private string $_host = '';
    private string $_sender = 'Магазинчик';

    public string $error = '';
    public string $succes = '';

    public function __construct($config = [])
    {
        $this->setApiKey(ArrayHelper::getValue($config, 'apiKey', Yii::$app->params['api']['SmsPilot']['apiKey']));
        $this->setHost(ArrayHelper::getValue($config, 'apiKey', Yii::$app->params['api']['SmsPilot']['host']));
        parent::__construct($config);
    }

    public function sendMessage(int $phone, string $text) {
        $url = $this->getHost()
            .'?send='.urlencode( $text )
            .'&to='.urlencode( $phone )
            .'&from='.$this->getSender()
            .'&apikey='.$this->getApiKey()
            .'&format=json';

        $json = file_get_contents( $url );

        $j = json_decode( $json );
        if ( !isset($j->error)) {
            $this->succes = 'SMS успешно отправлена server_id='.$j->send[0]->server_id;
        } else {
            $this->error = $j->error->description_ru;
        }
    }

    public function sendMessages(array $phones, string $text) {
        $send = array(
            'apikey' => $this->getApiKey(),
            'from' => $this->getSender(),
            'send' => $this->_formatSendForApi2($phones, $text)
        );

        $result = file_get_contents('https://smspilot.ru/api2.php', false, stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode( $send ),
            ),
        )));

        $j = json_decode( $result );

        if ( !isset($j->error)) {
            $this->succes = 'SMS успешно отправлены';
        } else {
            $this->error = $j->error->description_ru;
        }
    }

    private function _formatSendForApi2(array  $phones, string $text): array
    {
        $result = [];
        foreach ($phones as $index => $phone) {
            $result[] = [
                'id' => $index + 1,
                'to' => $phone,
                'text' => $text,
            ];
        }

        return $result;
    }

    /**
     * @return mixed|string
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }

    /**
     * @param mixed|string $_apiKey
     */
    public function setApiKey($_apiKey): void
    {
        $this->_apiKey = $_apiKey;
    }

    /**
     * @return mixed|string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param mixed|string $_host
     */
    public function setHost($_host): void
    {
        $this->_host = $_host;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->_sender;
    }


}