/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 9 de abril de 2014, 11:35 PM
 */

#include <cstdlib>
#include <math.h>
#include <time.h>
#include <iostream>

using namespace std;

float distribucion_uniforme(float ini, float end) {

    return ini + ((double)rand()/RAND_MAX) * (end - ini);

}

float distribucion_exponencial(float media) {

    return - media * log(distribucion_uniforme(0.0, 1.0));

}

/*
 * 
 */
int main(int argc, char** argv) {

    srand(time(NULL));
    
    float current_time = 0;
    float end_time = 100000; //100000 minutos
    float tiempo_llegada_medio = 30.0; //20 minutos
    
    float next_event = current_time + distribucion_exponencial(tiempo_llegada_medio);

    for(current_time=0; current_time<end_time; current_time++){
        
        if(current_time >= next_event){
            
            std::cout << "Se genera un evento en " << next_event << std::endl;
            
            next_event = current_time + distribucion_exponencial(tiempo_llegada_medio);
        }
        
        std::cout << "."; 
        
    }
    
    return 0;
}

