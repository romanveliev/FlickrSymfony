<?php
namespace Mars\RoverBundle\Controller;

use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DefaultController extends Controller
{
    /**
     * @var
     */
    private $data;
    private $content;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('upperRight', 'text', ['constraints' => [new NotBlank(), new Regex(["pattern"=>"/^[1-9] [1-9]$/","message"=>"Upper-Right coordinates are not valid."])],'attr'  => ['class' => 'btn'] ])
            ->add('coordinate1', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/^[1-9] [1-9] [N,W,S,E]$/","message"=>"Rover's coordinates are not valid."])],'attr'  => ['class' => 'btn'] ])
            ->add('direction1', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/[R,L,M]$/","message"=>"Instructions are not valid"])],'attr'  => ['class' => 'btn']])
            ->add('coordinate2', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/^[1-9] [1-9] [N,W,S,E]$/","message"=>"Rover's coordinates are not valid."])],'attr'  => ['class' => 'btn'] ])
            ->add('direction2', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/[R,L,M]$/","message"=>"Instructions are not valid"])],'attr'  => ['class' => 'btn'] ])
            ->add('save', 'submit', ['label' => 'Move', "attr"=>["class"=>"btn"] ] )
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
            ];
            foreach ($array as $value) {
                $model = new Rover($value[0], $value[1], $upperRight);
                $this->data[] = $model->changeDirection();
            }

        }

        return $this->render('MarsRoverBundle:Default:index.html.twig', array(
            'form' => $form->createView(),'rovers'=>$this->data));
    }


}
