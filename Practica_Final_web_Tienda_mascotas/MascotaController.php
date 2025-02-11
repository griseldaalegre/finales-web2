<?

require_once 'MascotasModel';
require_once 'MascotasView';
require_once 'HistoriaClinicaModel';
require_once 'ClienteModel';

class MascotaController{

    public $mascotaView;
    public $mascotaModel;
    public $historiaClinica;
    public $cliente;

    public function __construct()
    {
        $this->cliente=new ClienteModel();
        $this->mascotaModel=new MascotasModel();
        $this->mascotaView= new MascotaView();
        $this->historiaClinica=new HistoriaClinicaModel();
    }
    
    public function deleteMascota($id){
        $mascota=$this->mascotaModel->getMascota($id);
        if(!empty($mascota)){
            $historial=$this->historiaClinica->getHistorial($id);
            if(empty($historial)){
                $this->mascotaModel->delete($id);
                $cliente=$mascota['id_cliente'];
                $cantidad_mascotas=$this->mascotaModel->getMascotaByClient($cliente);
                if($cantidad_mascotas<1){
                    $this->cliente->deleteById($cliente);
                    $this->mascotaView->reponse("mascota y cliente eliminados",200);
                }

                $this->mascotaView->reponse("mascota eliminada",200);
            }
            $this->mascotaView->reponse("error al eliminar posee historial clinico",404);
        }
        $this->mascotaView->reponse("no existe la mascota ",404);

    }








}