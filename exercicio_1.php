<?php
  /** Criar uma função que receba uma string que pode conter chaves, parentes e colchetes,
   * a função deve validar se à abertura e fechamento está sendo executado na sequência correta:
   * Não contém colchetes sem correspondência
   * O subconjunto de colchetes dentro dos limites de um par de colchetes correspondente é também um par de colchetes.
   * */
function validacao_colchetes($valor) {
    
    $caracter = [];
    $pilha_encadeada = [];
    
    /* somente os caracteres abaixo devem ser utilizado na válidação sempre respeitando a ordem, caracter de abertuta deve estar na mesma posição dentro caracter de fechamento*/
    $caracter_abertura = ['(', '{', '[','<'];
    $caracter_fechamento = [')', '}', ']','>'];
    
    $lista_caracter = str_split($valor);

    foreach ($lista_caracter as $caracter_atual) {
        
        if (in_array($caracter_atual, $caracter_abertura)) { //Validar se $caracter_atual é um dos caracters pertecente lista de $caracter_abertura
            array_push($caracter, $caracter_atual); //Adicinar caracter recebido a uma array para ir comparando se a sequência esta correto
            array_push($pilha_encadeada, []); //Para cada caracter de abertura sera salvo um array vazio dentro da pilha para saber a posição dentro da pilha
        } elseif (in_array($caracter_atual, $caracter_fechamento)) { //Validar se $caracter_atual é um dos caracters pertecente lista de $caracter_fechamento
            $caracter_abertura_corresponde = array_pop($caracter); //Pegando último elemento da pilha para ser comparado com o caracter esperado
            $nested_brackets = array_pop($pilha_encadeada); //Estou pegando o úlitmo elemento empilhado para ser verificado se esta vazio
            
            /* Pegar com array_search a posição do caracter dentro do array de fechamento passando a posição para o */
            $caracter_abertura_esperado = $caracter_abertura[array_search($caracter_atual, $caracter_fechamento)];
            
            if ($caracter_abertura_corresponde !== $caracter_abertura_esperado || !empty($nested_brackets)) {
                return false;
            }
        } else {
            continue;
        }
    }

    
    return empty($caracter) && empty($nestedStack);
}

$sequence1 = "(){}[]";
$sequence2 = "[{()}](){}";
$sequence3 = "[]{()";
$sequence4 = "[{)]";
$sequence5 = "[]<>";

function dd(...$args){

    foreach($args as $arg){
        echo '<pre>' . var_dump($arg) . '</pre>';
    }
}

// dd($sequence1, validacao_colchetes($sequence1));
// dd($sequence2, validacao_colchetes($sequence2));
// dd($sequence3, validacao_colchetes($sequence3));
// dd($sequence4, validacao_colchetes($sequence4));
dd($sequence5, validacao_colchetes($sequence5));
