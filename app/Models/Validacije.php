<?php
class Validacije {

    public function DaLiJePacijentPrimljen($BrojeviBolesti, $NoviBrojBolesti) {
        if (stripos($BrojeviBolesti, $NoviBrojBolesti) !== false) {
            return ' Није могуће обрисати податке о пацијенту за који се чувају подаци о хоспитализацији ';
        }
    }

    public function DaLiJeJedinstvenBrojBolesti($BrojeviBolesti, $NoviBrojBolesti) {
        if (stripos($BrojeviBolesti, $NoviBrojBolesti) !== false) {
            return ' Пацијент са овим бројем болести се већ налази у бази болнице, проверите да ли сте унели исправан број, уколико јесте потражите пацијента у листи пацијената ';
        }
    }
}
