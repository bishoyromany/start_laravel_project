import createProject.projectSettings as projectSettings
import createProject.createLaravelProject as createLaravelProject

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
        print("Here :D")
