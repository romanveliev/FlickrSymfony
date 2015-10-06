<?php
namespace Mars\RoverBundle\Controller;

use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DefaultController extends Controller
{

    private $data;
    private $content;
    private $output;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('upper_right', 'text', ['constraints' => [new NotBlank(), new Regex(["pattern"=>"/^[1-9] [1-9]$/","message"=>"Upper-Right coordinates are not valid."])],'attr'  => ['class' => 'form-control'] ])
            ->add('coordinate_1', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/^[1-9] [1-9] [N,W,S,E]$/","message"=>"Rover's coordinates are not valid."])],'attr'  => ['class' => 'form-control'] ])
            ->add('direction_1', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/[R,L,M]$/","message"=>"Instructions are not valid"])],'attr'  => ['class' => 'form-control']])
            ->add('coordinate_2', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/^[1-9] [1-9] [N,W,S,E]$/","message"=>"Rover's coordinates are not valid."])],'attr'  => ['class' => 'form-control'] ])
            ->add('direction_2', 'text',['constraints'=>[new NotBlank(),new Regex(["pattern"=>"/[R,L,M]$/","message"=>"Instructions are not valid"])],'attr'  => ['class' => 'form-control'] ])
            ->add('save', 'submit', ['label' => 'move', "attr"=>["class"=>"btn btn-default", 'role' => 'submit'] ] )
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

        /** ajax response */
        if ($request->isXMLHttpRequest()) {
            $translator = $this->get('translator');
            $type = json_decode($request->query->get('type'));
            if($type == 'content'){
                $this->content = $this->renderView('MarsRoverBundle:ajax:form.html.twig',
                            ['form' => $form->createView(),'rovers'=>$this->data]
                        );

                $this->output = ['html' => $this->content,
                                 'data' => [
                                    'header' => $translator->trans('mars_project')
                                ]
                ];
                return new JsonResponse($this->output);
            }
        }

        return $this->render('MarsRoverBundle:Default:index.html.twig', [
            'form' => $form->createView(),'rovers'=>$this->data]);
    }

    public function ajaxMoveAction(Request $request){
        if($request->isXmlHttpRequest()){
            $translator = $this->get('translator');
            $instructions = json_decode($request->request->get('instructions'));

            foreach($instructions as $instruction){
                if(empty($instruction)){
                    return new JsonResponse($translator->trans('check_inputs'));
                }
            }

            if(!preg_match( '/^[1-9] [1-9]$/', $instructions[0])){
                return new JsonResponse($translator->trans('upper_right_coordinates_are_not_valid'));
            }
            if(!preg_match( '/^[1-9] [1-9] [N,W,S,E]$/', $instructions[1]) && !preg_match( '/^[1-9] [1-9] [N,W,S,E]$/', $instructions[3])){
                return new JsonResponse($translator->trans('rovers_coordinates_are_not_valid'));
            }

            if(!preg_match( '/[R,L,M]$/', $instructions[2]) || !preg_match( '/[R,L,M]$/', $instructions[4])){
                return new JsonResponse($translator->trans('instructions_are_not_valid'));
            }


            $upperRight = explode(' ',$instructions[0]);
            $array = [
                [
                    $instructions[1], $instructions[2]
                ],
                [
                    $instructions[3], $instructions[4]
                ],
            ];
            foreach ($array as $value) {
                $model = new Rover($value[0], $value[1], $upperRight);
                $this->data[] = $model->changeDirection();
            }

            $this->content = $this->renderView('MarsRoverBundle:ajax:coordinates.html.twig',[
                    'rovers' => $this->data
            ]);

            $this->output = [ 'html' => $this->content ];

            return new JsonResponse($this->output);
        }

    }
}
