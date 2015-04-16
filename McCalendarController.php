<?php
/**
* This file is part of the "MensaCymru Calendar" plugin for Wolf CMS.
* Licensed under an GPL style license. For full details see license.txt.
*
* @author Giles Metcalf <giles@lughnasadh.com>
* @copyright Giles Metcalf, 2015
*
* Original authors:
*
* @author Jacek Ciach <jacek.ciach@wp.eu>
* @copyright Jacek Ciach, 2014
*
*/

if (!defined('IN_CMS')) { exit(); }

class McCalendarController extends PluginController {

    private static function _checkPermission() {
        AuthUser::load();
        if (!AuthUser::isLoggedIn()) {
            redirect(get_url('login'));
        }
    }

    public function __construct() {
        self::_checkPermission();   

        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/mc_calendar/views/sidebar'));
    }

    // Take me to all events
    public function index() {
        $this->events();
    }

    // Documentation
    public function documentation() {
        $this->display(CALENDAR_VIEWS.'/documentation');
    }

    // Add new event
    public function new_event(){
        $this->display(CALENDAR_VIEWS.'/update');
    }
    
    // List all events
    public function events() {
        $events = CalendarEvent::findAllFrom('CalendarEvent','id=id ORDER BY date_from DESC, date_to DESC');
        $this->display(CALENDAR_VIEWS.'/events', array('events' => $events));
    }
    
    public function update($id){
        $event = CalendarEvent::findByIdFrom('CalendarEvent', $id);
        $this->display(CALENDAR_VIEWS.'/update', array('event' => $event));
    }

    // Delete event
    public function delete($id) {
        $notes = CalendarEvent::findByIdFrom('CalendarEvent', $id);
        $notes->delete();
        Flash::set('success', __('The event has been successfully deleted'));

        redirect(get_url('plugin/mc_calendar/events'));
    }

    public function update_event(){

            if (!isset($_POST['save'])) {
                Flash::set('error', __('Could not update this event!'));
            }
            else {
                use_helper('Kses');
                                            
                /* Prepare the data */                            
                $data = $_POST['event'];
                if (isset($data['id']))
                  $data['id'] = kses(trim($data['id']), array());

                $event = new CalendarEvent();

                if (isset($data['id'])) {
                  $event->id            = $data['id'];
                  $event->created_by_id = $data['created_by_id'];
                }                 
                  
                $event->title       = $data['title'];
                $event->date_from   = $data['date_from'];
                $event->date_to     = $data['date_to'];
                $event->description = $data['description'];    
				$event->image_url   = $data['image_url'];
				$event->category_key= $data['category_key'];
				$event->host_id     = $data['host_id'];
                
                /* Check data and, if correct, save to DB */
                if ($event->checkData() && $event->save()) {
                  if (isset($data['id']))
                    Flash::set('success', __('The event has been updated.'));
                  else
                    Flash::set('success', __('A new event has been created.'));
                  
                  redirect(get_url('plugin/mc_calendar/events'));
                }
                else {
                  Flash::setNow('error', __('There are errors in the form.'));                
                  $this->display(CALENDAR_VIEWS.'/update', array('event' => $event));                
                }
        }

    }
	
	public function host_update() {
        $this->display(CALENDAR_VIEWS.'/host_update');
	
	}

	// List all categories
    public function categories() {
        $categories = CalendarCategory::findAllFrom('CalendarCategory');
        $this->display(CALENDAR_VIEWS.'/categories', array('categories' => $categories));
    }
 
	public function category_update($id){
        $category = CalendarCategory::findByIdFrom('CalendarCategory', $id);
        $this->display(CALENDAR_VIEWS.'/category_update', array('categories' => $category));
    }

	
	    // Add new category
    public function new_category(){
        $this->display(CALENDAR_VIEWS.'/category_update');
	}

	public function update_category(){

		if (!isset($_POST['save'])) {
			Flash::set('error', __('Could not update this category!'));
		}
		else {
			use_helper('Kses');
										
			/* Prepare the data */                            
			$data = $_POST['category'];
			if (isset($data['category_key']))
			  $data['category_key'] = kses(trim($data['category_key']), array());

			$category = new CalendarCategory();

			if (isset($data['category_key'])) {
			  $category->category_key  = $data['category_key'];
			}                 
			  
			$category->cat_title       = $data['cat_title'];
			$category->cat_image   = $data['cat_image'];
			$category->cat_color     = $data['cat_color'];
			
			/* Check data and, if correct, save to DB */
			if ($category->checkData() && $category->save()) {
			  if (isset($data['id']))
				Flash::set('success', __('The event has been updated.'));
			  else
				Flash::set('success', __('A new event has been created.'));
			  
			  redirect(get_url('plugin/mc_calendar/events'));
			}
			else {
			  Flash::setNow('error', __('There are errors in the form.'));                
			  $this->display(CALENDAR_VIEWS.'/categories', array('categories' => $categories));                
			}
		}

    }

	public function delete_category($id) {
        $notes = CalendarCategory::findByIdFrom('CalendarCategory', $id);
        $notes->delete();
        Flash::set('success', __('The event has been successfully deleted'));

        redirect(get_url('plugin/mc_calendar/categories'));
	
	}
}