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
    /**
     * @var
     */
    private $data;
    private $content;
    private $output;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        if ($request->isXMLHttpRequest()) {
            $translator = $this->get('translator');
            $type = json_decode($request->query->get('type'));

            if($type == 'content'){
                $form = "<form class='form-group'>
                        <label for='form_upperRight'>".$translator->trans('upper_right')."</label><input type='text' id='form_upperRight' name='form[upperRight]' class='form-control'>
                        <label for='form_coordinate1'>".$translator->trans('coordinate_1')."</label><input type='text' id='form_coordinate1' name='form[coordinate1]' class='form-control'>
                        <label for='form_direction1'>".$translator->trans('direction_1')."</label><input type='text' id='form_direction1' name='form[coordinate1]' class='form-control'>
                        <label for='form_coordinate2'>".$translator->trans('coordinate_2')."</label><input type='text' id='form_coordinate2' name='form[coordinate2]' class='form-control'>
                        <label for='form_direction2'>".$translator->trans('direction_2')."</label><input type='text' id='form_direction2' name='form[coordinate2]' class='form-control'>
                        <input type='button' class='btn btn-default' value='".$translator->trans('move')."'>
                    </form>";

                $this->output = [
                    $form, $translator->trans('mars_project')
                ];
                return new JsonResponse($this->output);
            }

            if($type == 'header'){
                $this->output = [
                    '<p>HEADER MARS</p>', $translator->trans('mars_project')
                ];
                return new JsonResponse($this->output);

            }
        }


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
