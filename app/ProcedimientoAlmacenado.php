<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProcedimientoAlmacenado extends Model
{
    public static function desactivar_usuario($user_id)
    {
    	$user = User::find($user_id);
    	$user->bloqueado = true;
    	$user->save();
    	return;
    }

    public static function avance_apoyo_economico($medida_id)
    {
    	$medida = Medida::find($medida_id);
        $apoyo_economico = ApoyoEconomico::find($medida->medida_id);
        $monto_minimo = $apoyo_economico->monto_minimo;
        $monto_actual = $apoyo_economico->monto_actual;

        $avance_recaudacion = ($monto_actual*100)/$monto_minimo;

        if ($avance_recaudacion > 100) 
        {
            $avance_recaudacion = 100;   
        }

        $medida->avance = $avance_recaudacion;
        $medida->save();
    }

    public static function avance_evento_beneficio($medida_id)
    {
        $medida = Medida::find($medida_id);
        $evento_a_beneficio = EventoBeneficio::find($medida->medida_id);
        $cantidad_materiales = Material::where('medida_id',$medida->id)->count();
        $materiales = Material::where('medida_id',$medida->id)->get();

        $avance_materiales = 0;

        foreach ($materiales as $material) 
        {
            $avance_parcial = ($material->recibido*100)/$material->necesario;
            if ($avance_parcial >100)
            {
                $avance_parcial = 100;
            }

            $avance_materiales += $avance_parcial;
        }

        $medida->avance = $avance_materiales/$cantidad_materiales;
        $medida->save();
    }

    public static function avance_recoleccion($medida_id)
    {
         $medida = Medida::find($medida_id);
         $recoleccion = Recoleccion::find($medida->medida_id);
         $cantidad_aportes = Aporte::where('recoleccion_id', $recoleccion->id)->count();
         $aportes = Aporte::where('recoleccion_id',$recoleccion->id)->get();
         //echo $aportes[0]->get;
         $avance_aportes = 0;
         
         foreach ($aportes as $aporte) 
         {
            $avance_parcial = ($aporte->recibido*100)/$aporte->necesario;
            if ($avance_parcial >100)
            {
                $avance_parcial = 100;
            }

            $avance_aportes += $avance_parcial;
         }

         $medida->avance = $avance_aportes/$cantidad_aportes;
         $medida->save();
    }

    public static function avance_voluntariado($medida_id)
    {
        $medida = Medida::find($medida_id);
        $voluntariado = Voluntariado::find($medida->medida_id);
        $tareas_finalizadas = 0;
        $cantidad_tareas = Tarea::where('voluntariado_id', $voluntariado->id)->count();
        $tareas = Tarea::where('voluntariado_id', $voluntariado->id)->get();
        
        foreach ($tareas as $tarea) 
        {
            if ($tarea->finalizada == true) 
            {
                $tareas_finalizadas += 1;
            }
        }

        $medida->avance = ($tareas_finalizadas*100)/$cantidad_tareas;
        $medida->save();
    }
}
