import serve.projectSettings as projectSettings
import serve.createLaravelProject as createLaravelProject

if __name__ == '__main__':
    # ? Get Project Settings
    projectSettingsObject = projectSettings.getProjectSettings()
    projectSettings = projectSettingsObject.getProjectSettings()
    # projectSettingsObject.startInput()

    # ? Start Creating The Project
    createLaravelProjectObject = createLaravelProject.createLaravelProject(
        projectSettings)

    print(createLaravelProjectObject.create())

    input("Press Enter To Close...")
