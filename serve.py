import createProject.projectSettings as projectSettings
import createProject.createLaravelProject as createLaravelProject

import updateProject.updateProjectSettings as updateProjectSettings
import updateProject.updateLaravelProject as updateLaravelProject

if __name__ == '__main__':
    section = input(
        "What do you wanna do ? [create/update] Project ['create'] \n")

    if section != 'update':
        # ? Get Project Settings
        projectSettingsObject = projectSettings.getProjectSettings()
        projectSettings = projectSettingsObject.getProjectSettings()
        projectSettingsObject.startInput()

        # ? Start Creating The Project
        createLaravelProjectObject = createLaravelProject.createLaravelProject(
            projectSettings)

        print(createLaravelProjectObject.create())

        input("Press Enter To Close...")
    else:
        # ? Get Project Settings
        projectSettingsObject = updateProjectSettings.updateProjectSettings()
        projectSettings = projectSettingsObject.getProjectSettings()
        projectSettingsObject.startInput()

        # ? Start Creating The Project
        createLaravelProjectObject = updateLaravelProject.updateLaravelProject(
            projectSettings)

        print(createLaravelProjectObject.create())

        input("Press Enter To Close...")
