<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  <h2 class="text-center"> Ville </h2>
                                <div class="row justify-content-around">
                                <?php $infos_batiments = get_information_buildings_return($id_partie_get); ?>
                                    <div class="batiment caserne col-6">
                                        <button onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"><?php echo $infos_batiments[0]->xp ?></span></p>
                                        <p>type = <span class="type"><?php echo $infos_batiments[0]->type ?></span></p>
                                        <p>niveau = <span class="level"><?php echo $infos_batiments[0]->niveau ?></span></p>
                                    </div>
                                    <div class="batiment banque col-6">
                                        <button onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"><?php echo $infos_batiments[1]->xp ?></span></p>
                                        <p>type = <span class="type"><?php echo $infos_batiments[1]->type ?></span></p>
                                        <p>niveau = <span class="level"><?php echo $infos_batiments[1]->niveau ?></span></p>
                                    </div>
                                    <div class="batiment maison col-6">
                                        <button onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"><?php echo $infos_batiments[2]->xp ?></span></p>
                                        <p>type = <span class="type"><?php echo $infos_batiments[2]->type ?></span></p>
                                        <p>niveau = <span class="level"><?php echo $infos_batiments[2]->niveau ?></span></p>
                                    </div>
                                    <div class="batiment hopital col-6">
                                        <button onclick="upgrade_building(this.parentNode.id, <?php echo $id_partie_get ?>)">AMELIORER</button>
                                        <p>xp = <span class="xp"><?php echo $infos_batiments[3]->xp ?></span></p>
                                        <p>type = <span class="type"><?php echo $infos_batiments[3]->type ?></span></p>
                                        <p>niveau = <span class="level"><?php echo $infos_batiments[3]->niveau ?></span></p>
                                    </div>
                                </div>