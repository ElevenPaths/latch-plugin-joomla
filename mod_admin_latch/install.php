<?php

class mod_admin_latchInstallerScript
{
         /**
         * Called before any type of action
         *
         * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
         * @param   JAdapterInstance  $adapter  The object responsible for running this script
         *
         * @return  boolean  True on success
         */
        public function preflight($route, JAdapterInstance $adapter) { }
 
        /**
         * Called after any type of action
         *
         * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
         * @param   JAdapterInstance  $adapter  The object responsible for running this script
         *
         * @return  boolean  True on success
         */
        public function postflight($route, JAdapterInstance $adapter) { }
 
        /**
         * Called on installation
         *
         * @param   JAdapterInstance  $adapter  The object responsible for running this script
         *
         * @return  boolean  True on success
         */
        public function install(JAdapterInstance $adapter) {
			// Enable module
			$query = "update `#__extensions` set enabled=1 where type = 'module' and element = 'mod_admin_latch'";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			$db->query();

			// Module assignment
			$query = "insert into `#__modules_menu` (menuid, moduleid) select 0 as menuid, id as moduleid from `#__modules` where module = 'mod_admin_latch'";
			$db->setQuery($query);
			$db->query();
			
			// Module default location
			$query = "update `#__modules` set position='cpanel',ordering=1,published=1,access=3 where module = 'mod_admin_latch'";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			$db->query();
		}
 
        /**
         * Called on update
         *
         * @param   JAdapterInstance  $adapter  The object responsible for running this script
         *
         * @return  boolean  True on success
         */
        public function update(JAdapterInstance $adapter) { }
 
        /**
         * Called on uninstallation
         *
         * @param   JAdapterInstance  $adapter  The object responsible for running this script
         */
        public function uninstall(JAdapterInstance $adapter) {
			$query = "delete from `#__user_profiles` where profile_key = 'latch.id'";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			$db->query();
		}
}