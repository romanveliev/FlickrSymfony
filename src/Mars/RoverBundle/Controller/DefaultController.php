<?php
namespace Mars\RoverBundle\Controller;

use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @var
     */
    private $data;
    private $content;

    public function indexAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('upperRight', 'text')
            ->add('coordinate1', 'text')
            ->add('direction1', 'text')
            ->add('coordinate2', 'text')
            ->add('direction2', 'text') ->add('coordinate3', 'text')
            ->add('direction3', 'text')
            ->add('save', 'submit', array('label' => 'Move'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            $arr = $request->request->all();

            $upperRight = explode(' ',$arr['form']['upperRight']);
            $array = [
                [
                    $arr['form']['coordinate1'],$arr['form']['direction1']
                ],
                [
                    $arr['form']['coordinate2'],$arr['form']['direction2']
                ],
                [
                    $arr['form']['coordinate3'],$arr['form']['direction3']
                ],
            ];
            foreach ($array as $value) {
                $this->data[] = new Rover($value[0], $value[1], $upperRight);
            }


//            foreach($this->data as $value){
//                $this->content[] = ['x' => $value->getX(), 'y' => $value->getY(), 'direction' => $value->getDirection()];
//            }

        }



        return $this->render('MarsRoverBundle:Default:index.html.twig', array(
            'form' => $form->createView(),'rovers'=>$this->data));
    }
}
