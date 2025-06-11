<?php

    function grup1() {
      // 4:instructor
      return ['4'];
    }
     function grup2() {
      // student
      return ['6'];
    }
     function grup3() {
      //2: administrator, 3: admin, 5: PIC
      return ['2', '3', '5'];
    }

    function role_available() {
      return ['4', '6'];
    }

    function canAddModul($role) {
      if(in_array($role, grup1())) {
        return true;
      }
    }
?>