<?php

class validation {

/*
 * Idéia da classe foi retirada do Framework CodeIgniter
 * http://www.codeigniter.com.br/manual/libraries/validation.html
 * 
 * Classe adaptada por Túlio Spuri, para ser usado sem o Framework.
 * http://alunos.dcc.ufla.br/~tulios/classe-validacao-formulario
 * 
 * Contato: tulios@comp.ufla.br
 */

    var $_array_erros 					= array();
    var $_regras						= array();
    var $_campos						= array();
    var $_campo_atual 					= '';
    var $_erros							= '';
    var $_prefixo_erro					= '<p>';
    var $_sufixo_erro					= '</p>';
    var $_mensagens						= array();
    var $_mensagens_personalizadas		= array();
    var $_campos_testes					= array();
    var $_short_message					= FALSE;
    var $_aux							= '';


    // -------------------------------------------------------

    /*
     * Construtor
     *
     * O construtor carrega as mensagens
     */

    function __construct() {
        $this->load_mensagens();
    }

    // -------------------------------------------------------

    /*
     * Required
     *
     * Este método analisa se o campo está em branco.
     */

    function required($str) {
        return (trim($str) == '') ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Min Caracter
     *
     * Este método analisa se o campo tem
     * um número menor de caracteres do que
     * o valor passado no parametro
     */


    function min_caracter($str, $tam) {
        if (preg_match("/[^0-9]/", $tam)) {
            return TRUE;
        }

        return (strlen(trim($str)) < $tam) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Max Caracter
     *
     * Este método analisa se o campo tem
     * um número maior de caracteres do que o valor
     * passado por parametro
     */

    function max_caracter($str, $tam) {
        if (preg_match("/[^0-9]/", $tam)) {
            return TRUE;
        }

        return (strlen(trim($str)) > $tam) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Exact Caracter
     *
     * Este método analisa se o campo tem exatamente
     * o número de caracteres passado por parametro
     */

    function exact_caracter($str, $tam) {
        if (preg_match("/[^0-9]/", $tam)) {
            return TRUE;
        }
        return (strlen(trim($str)) != $tam) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Email Valido
     *
     * Este método analisa se o campo
     * contém um e-mail válido
     */

    function email_valido($str) {
        return (! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Mac
     * 
     * Este método analisa se o campo contém
     * um endereço MAC válido
     */

    function mac($str) {
        return (! preg_match("/^(([0-9a-f]{2}):){5}([0-9a-f]{2})$/i", $str)) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Alfanumerico
     *
     * Este método analisa se no campo
     * existem somente caracteres alfanumericos.
     * É aceitável também caracteres acentudados.
     */


    function alfanumerico($str) {
        return ( ! preg_match("/^[a-z0-9áraâéceíeîónôoúuuç\&\;\s]+$/i", $str)) ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Alfa
     *
     * Este método analisa se no campo
     * existem somente caracteres alfa.
     * É aceitável também caracteres acentudados.
     */


    function alfa($str) {
        return ( ! preg_match("/^[a-záraâéceíeîónôoúuuç\&\;\s]+$/i", $str)) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Telefone
     *
     * Este método analisa se o campo contém
     * um número de telefone na forma (xx)xxxx-xxxx
     */

    function telefone($str) {
        return ( ! preg_match('/\([1-9]{1}[0-9]{1}\)[0-9]{4}\-[0-9]{4}$/',$str)) ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Cep
     *
     * Este método analisa se o campo contém
     * um Cep na forma xxxxx-xxx
     */


    function cep($str) {
        return ( ! preg_match('/^[0-9]{5}\-[0-9]{3}$/', $str)) ? TRUE : FALSE;
    }


    // -------------------------------------------------------

    /*
     * Matches
     *
     * Este método analisa se o campo casa/combina
     * com o campo passado por parametro.
     */

    function matches($str, $field) {
        if ( ! isset($_POST[$field])) {
            return FALSE;
        }

        return ($str !== $_POST[$field]) ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Numerico
     *
     * Este método analisa se o campo contém
     * um valor númerico
     */


    function numerico($str) {
        return ( ! preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str)) ? TRUE : FALSE;

    }

    function ip($str) {
        return ( ! preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/',$str)) ? TRUE : FALSE;
    }

    // -------------------------------------------------------

    /*
     * Set Rules
     *
     * Este método recebe um array com o nomes dos campos
     * e com as regras de validação armazena em outro array
     * de forma simples para ser usado depois
     *
     */

    function set_rules($data, $rules = '') {
        if ( ! is_array($data)) {
            if ($rules == '')
                return;

            $data = array($data => $rules);
        }

        foreach ($data as $key => $val) {
            $this->_regras[$key] = $val;
        }

    }


    // -------------------------------------------------------

    /*
     * Set Error Delimiters
     *
     * Este método altera os delimitadores (prefixo e sufixo)
     * que acompanham as mensagens de erro.
     * Por padrão
     *  - Prefixo: <p>
     *  - Sufixo:  </p>
     *
     */

    function set_error_delimiters($prefix = '<p>', $suffix = '</p>') {
        $this->_prefixo_erro = $prefix;
        $this->_sufixo_erro = $suffix;
    }

    // -------------------------------------------------------

    /*
     * Set Short Message
     *
     * Por padrão Short Message é FALSE (desligado).
     * Ou seja, as mensagens de erros são exibidas da seguinte forma:
     *  - O campo nome deve ser preenchido.
     *  - O campo sexo deve ser preenchido.
     *
     * Se Short Message é TRUE (ligado).
     * As mensagens são exibidas da seguinte forma:
     *  - O campo nome, sexo deve ser preenchido
     */

    function set_short_message ($value = FALSE) {
        $this->_short_message = $value;
    }


    // -------------------------------------------------------

    /*
     * Get Mensagens
     *
     * Este método retorna a mensagem do erro
     * de validação
     */

    function load_mensagens() {

        $this->_mensagens['required_plural']       = "Os campos %s devem ser preenchidos.";
        $this->_mensagens['email_valido_plural']   = "Os campos %s devem conter um email válido.";
        $this->_mensagens['min_caracter_plural']   = "Os campos %s nao devem ser menor que %s caracteres";
        $this->_mensagens['max_caracter_plural']   = "Os campos %s nao devem conter mais que %s caracteres";
        $this->_mensagens['exact_caracter_plural'] = "Os campos %s devem conter %s caracteres";
        $this->_mensagens['alfa_plural']           = "Os campos %s devem conter apenas letras";
        $this->_mensagens['alfanumerico_plural']   = "Os campos %s devem conter apenas letras e/ou numeros";
        $this->_mensagens['telefone_plural']       = "Os campos %s devem um número telefonico na forma (xx)xxxx-xxxx";
        $this->_mensagens['cep_plural']            = "Os campos %s devem conter um CEP na forma xxxxx-xxx";
        $this->_mensagens['matches_plural']        = "Os campos %s devem ser igual ao campo %s";
        $this->_mensagens['numerico_plural']       = "Os campos %s devem conter um número";
        $this->_mensagens['mac_plural']            = "Os campos %s devem conter um endere&ccedil;o MAC válido";
        $this->_mensagens['ip_plural']             = "Os campos %s devem conter um endere&ccedil;o de IP válido";

        $this->_mensagens['required']              = "O campo %s deve ser preenchido.";
        $this->_mensagens['email_valido']          = "O campo %s deve conter um email válido.";
        $this->_mensagens['min_caracter']          = "O campo %s nao deve ser menor que %s caracteres";
        $this->_mensagens['max_caracter']          = "O campo %s nao deve conter mais que %s caracteres";
        $this->_mensagens['exact_caracter']        = "O campo %s deve conter %s caracteres";
        $this->_mensagens['alfa']                  = "O campo %s deve conter apenas letras";
        $this->_mensagens['alfanumerico']          = "O campo %s deve conter apenas letras e/ou numeros";
        $this->_mensagens['telefone']              = "O campo %s deve um número telefonico na forma (xx)xxxx-xxxx";
        $this->_mensagens['cep']                   = "O campo %s deve conter um CEP na forma xxxxx-xxx";
        $this->_mensagens['matches']               = "O campo %s deve ser igual ao campo %s";
        $this->_mensagens['numerico']              = "O campo %s deve conter um número";
        $this->_mensagens['mac']                   = "O campo %s deve conter um endere&ccedil;o MAC válido";
        $this->_mensagens['ip']                    = "O campo %s deve conter um endere&ccedil;o de IP válido";

    }


    // -------------------------------------------------------

    /*
     * Set Campos
     *
     * Este métodos é usado para alterar o nome dos campos.
     * Quando voce define um campo <input name="email"...
     * Na validaçao deste campo, caso retorne uma mensagem de erro
     * o nome que exibido será "email".
     * Usando este método voce altera para o nome desejado
     *
     * A funçao recebe 1 ou 2 parametros:
     * - Um parametro:
     *   Este parametro deverá ser um array, onde a chave é o nome
     *   original do campo e o valor o nome alterado.
     *
     * - Dois parametros:
     *   O primeiro parametro deve ser o nome original do campo
     *   e o segundo o nome alterado
     */

    function set_campos($data, $name = '') {
        if (is_array($data)) {
            foreach ($data as $chave => $nome) {
                $this->_campos[$chave] = $nome;
            }
        }
        else {
            $this->_campos[$data] = $name;
        }
    }

    // -------------------------------------------------------

    /*
     * Set Mensagens
     *
    * Este método é usado para alterar as mensagens de erros padroes.
     *
     * A funçao recebe 1 ou 2 parametros:
     * - Um parametro:
     *   Este parametro deverá ser um array, onde a chave é o nome
     *   da regra de validaçao e o valor deve ser a mensagem personalizada
     *
     * - Dois parametros:
     *   O primeiro parametro deve ser o nome da regra de validaçao
     *   e o segundo a mensagem personalizada.
     *
     * O padrao para escrita de mensagens deve ser igual ao do
     * método load_mensagens();
     */

    function set_mensagens($data, $message = '') {

        if (is_array($data)) {
            foreach ($data as $key => $msg) {
                $this->_mensagens_personalizadas[$key] = $msg;
            }
        }
        else {
            $this->_mensagens_personalizadas[$data] = $message;
        }
    }


    // -------------------------------------------------------

    /*
     * Isn't Required
     *
     * Este método verifica se o campo é requerido/obrigatório
     */

    function isnt_required($field) {
        if (!preg_match('/required/i', $this->_regras[$field])) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }


    // -------------------------------------------------------

    /*
     * Get Errors Messages
     *
     * Este método monta as mensagens de erros
     */

    function get_errors_messages ($campo, $rule, $param) {


        $line = ( ! isset($this->_mensagens_personalizadas[$rule])) ? $this->_mensagens[$rule] : $this->_mensagens_personalizadas[$rule];

        $erro = $campo.'_erro';
		
        $mfield = ( ! isset($this->_campos[$campo])) ? $campo : $this->_campos[$campo];
        $mparam = ( ! isset($this->_campos[$param])) ? $param : $this->_campos[$param];
        $message = sprintf($line, $mfield, $mparam);

        $this->$erro = $message;
        $this->_array_erros[] = $message;

    }


    // -------------------------------------------------------

    /*
     * Executar
     *
     * Este método faz todo o trabalho!
     *
     * Retorna TRUE, se todas as regras de validação foram atendidas
     * Retorna FALSE, caso contrário
     */

    function executar() {

        foreach($this->_regras as $campo => $regras) {

            $ex = explode('|', $regras);

            $this->_campo_atual = $campo;

            foreach($ex as $rule) {
				
				$param = '';
				
                if (preg_match("/(.*?)\[(.*?)\]/", $rule, $match)) {
                    $rule	= $match[1];
                    $param	= $match[2];
                }
			
		/*
        	 * Se a regra de validação passada no array não
		 * corresponder a um método da classe, então
		 * irá ser testado como uma função nativa do PHP
		 */
                if ( ! method_exists($this, $rule)) {

                    $_POST[$campo] = $rule($_POST[$campo]);
                    continue;

                }


		/*
		 * Se o campo NAO for requerido/obrigatorio:
                 *   E o campo estiver vazio, NENHUMA regra de validaçao será aplicada.
		 *   E o campo NAO estiver vazio, as regras de validaçao SERAO aplicadas.
		 */
                if ($this->isnt_required($campo)) {

                    if ($_POST[$campo] == '') {
                        continue 2;
                    }

                }


		/*
		 * Caso a regra de validação exista na classe
		 * ela irá ser executada
		 */
                $result = $this->$rule($_POST[$campo], $param);
		
					
                if ($result === TRUE) {

                    /*
                     * Se SHORT MESSAGE estiver como TRUE (ligado)
                     * então será armazenado em um array:
                     *
                     * No índice: O nome do campo
                     * Valor    : A regra juntamente com o parametro, caso a regra tiver
                     *
                     * Este array será usado mais tarde para gerar as mensagens
                     * de erros
                     *
                     * O nome frequencia se deve ao fato, de que
                     * quando o método executar() terminar os dois
                     * foreach's que estão em execução, o array frequencia
                     * terá todas as regras que não foram atendidas pelos respectivos
                     * campos e o array CONTA (criado logo abaixo) irá guardar o
                     * número de vezes que determinada regra foi
                     * usada, para no final poder colocar as virgulas e o 'e'
                     * separando os campos na mensagem de erro
                     */

                    if ($this->_short_message == TRUE) {
                        $frenquencia[$campo] = $rule."[".$param."]";
					    $param = '';
                    }
                    else {
                        /*
                         * Caso SHORT MESSAGE estiver FALSE (desligado)
                         * A mensagem de erro será gerada em seguida
                         */
					    $mfield = ( ! isset($this->_campos[$campo])) ? ucwords($campo) : $this->_campos[$campo];					
                        $this->get_errors_messages($mfield, $rule);
                    }
                    
                    continue 2;

                }

            }
        }


        /*
         * Ao sair dos 2 foreach's que estavam em execução
         * as mensagens de erros vão ser geradas
         */
        if ($this->_short_message == TRUE) {

            $conta = array_count_values($frenquencia);
            $pluralOrSingular = $conta;

            $output = '';

            foreach ($frenquencia as $campo => $ruleParam) {

                    if (preg_match("/(.*?)\[(.*?)\]/", $ruleParam, $match)) {
                        $rule	= $match[1];
                        $param	= $match[2];
                    }

			        $mfield = ( ! isset($this->_campos[$campo])) ? $campo : $this->_campos[$campo];					

                    $saida[$rule."[".$param."]"] .= ucwords($mfield);

                    if ($conta[$ruleParam] == 1) {
                        continue;
                    }
                    else if ($conta[$ruleParam] > 2) {
                            $saida[$rule."[".$param."]"] .= ', ';
                            $conta[$ruleParam] -= 1;
                    }
                    else {
                            $saida[$rule."[".$param."]"] .= ' e ';
                            $conta[$ruleParam] -= 1;
                    }
					
            }
			
			 
            foreach ($saida as  $ruleParam => $campo) {

                if (preg_match("/(.*?)\[(.*?)\]/", $ruleParam, $match)) {
                    $rule	= $match[1];
                    $param	= $match[2];
                }

                    if ($pluralOrSingular[$ruleParam] > 1) {
                            $rule .= '_plural';
                    }

                $this->get_errors_messages($campo, $rule, $param);
            }

        }




        $total_errors = count($this->_array_erros);

    /*
	 * Se o número de erros for zero então
	 * retorna verdadeiro e a validação esta
	 * completa
	 */
        if ($total_errors == 0) {
            return TRUE;
        }


	/*
	 * Gera a string de erros e retorna falso
	 */
        foreach ($this->_array_erros as $val) {
            $this->_erros .= $this->_prefixo_erro.$val.$this->_sufixo_erro."\n";
        }

        return FALSE;

    }


    // -------------------------------------------------------

    /*
     * Mostra Erros
     *
     * Este método mostra os erros na tela.
     */
    function mostra_erros() {
        echo $this->_erros;
    }


}

?>