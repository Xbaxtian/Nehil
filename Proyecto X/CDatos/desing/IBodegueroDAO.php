<?php

interface IBodegueroDAO{
	
	public abstract function listabodeguero();
    public abstract function insertarbodeguero(BodegueroTO bodeguero);
    public abstract function actualizarbodeguero(BodegueroTO bodeguero);
    public abstract function eliminarbodeguero(List<Integer> idbodeguero);
    public abstract function datoabodegueroporid(Integer id);

}



?>